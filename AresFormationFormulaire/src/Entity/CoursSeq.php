<?php

namespace App\Entity;

use App\Repository\CoursSeqRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursSeqRepository::class)]
class CoursSeq
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'coursSeqs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cours $cours = null;

    #[ORM\ManyToOne(inversedBy: 'coursSeqs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $createur = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\Column]
    private ?int $ordre = null;

    #[ORM\ManyToMany(targetEntity: Document::class, inversedBy: 'coursSeqs')]
    private Collection $documents;

    #[ORM\OneToMany(mappedBy: 'coursSeq', targetEntity: CoursDistance::class)]
    private Collection $coursDistances;

    public function __construct()
    {
        $this->documents = new ArrayCollection();
        $this->coursDistances = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCours(): ?Cours
    {
        return $this->cours;
    }

    public function setCours(?Cours $cours): static
    {
        $this->cours = $cours;

        return $this;
    }

    public function getCreateur(): ?User
    {
        return $this->createur;
    }

    public function setCreateur(?User $createur): static
    {
        $this->createur = $createur;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): static
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * @return Collection<int, Document>
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): static
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);
        }

        return $this;
    }

    public function removeDocument(Document $document): static
    {
        $this->documents->removeElement($document);

        return $this;
    }

    /**
     * @return Collection<int, CoursDistance>
     */
    public function getCoursDistances(): Collection
    {
        return $this->coursDistances;
    }

    public function addCoursDistance(CoursDistance $coursDistance): static
    {
        if (!$this->coursDistances->contains($coursDistance)) {
            $this->coursDistances->add($coursDistance);
            $coursDistance->setCoursSeq($this);
        }

        return $this;
    }

    public function removeCoursDistance(CoursDistance $coursDistance): static
    {
        if ($this->coursDistances->removeElement($coursDistance)) {
            // set the owning side to null (unless already changed)
            if ($coursDistance->getCoursSeq() === $this) {
                $coursDistance->setCoursSeq(null);
            }
        }

        return $this;
    }


}
