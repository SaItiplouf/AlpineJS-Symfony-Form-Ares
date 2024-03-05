<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $createur = null;


    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToMany(targetEntity: SessionFormation::class, inversedBy: 'cours')]
    private Collection $promotion;

    #[ORM\ManyToMany(targetEntity: Formation::class, inversedBy: 'cours')]
    private Collection $formations;

    #[ORM\OneToMany(mappedBy: 'cours', targetEntity: CoursSeq::class)]
    private Collection $coursSeqs;

    #[ORM\ManyToMany(targetEntity: BlocCompetence::class, inversedBy: 'cours')]
    private Collection $competences;

    #[ORM\OneToMany(mappedBy: 'cours', targetEntity: CoursDistance::class)]
    private Collection $coursDistances;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Matiere $matiere = null;

    public function __construct()
    {
        $this->promotion = new ArrayCollection();
        $this->formations = new ArrayCollection();
        $this->coursSeqs = new ArrayCollection();
        $this->competences = new ArrayCollection();
        $this->coursDistances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCreateur(): ?User
    {
        return $this->createur;
    }

    public function setCreateur(?User $createur): static
    {
        $this->createur = $createur;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, SessionFormation>
     */
    public function getPromotion(): Collection
    {
        return $this->promotion;
    }

    public function addPromotion(SessionFormation $promotion): static
    {
        if (!$this->promotion->contains($promotion)) {
            $this->promotion->add($promotion);
        }

        return $this;
    }

    public function removePromotion(SessionFormation $promotion): static
    {
        $this->promotion->removeElement($promotion);

        return $this;
    }


    /**
     * @return Collection<int, Formation>
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): static
    {
        if (!$this->formations->contains($formation)) {
            $this->formations->add($formation);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): static
    {
        $this->formations->removeElement($formation);

        return $this;
    }

    /**
     * @return Collection<int, CoursSeq>
     */
    public function getCoursSeqs(): Collection
    {
        return $this->coursSeqs;
    }

    public function addCoursSeq(CoursSeq $coursSeq): static
    {
        if (!$this->coursSeqs->contains($coursSeq)) {
            $this->coursSeqs->add($coursSeq);
            $coursSeq->setCours($this);
        }

        return $this;
    }

    public function removeCoursSeq(CoursSeq $coursSeq): static
    {
        if ($this->coursSeqs->removeElement($coursSeq)) {
            // set the owning side to null (unless already changed)
            if ($coursSeq->getCours() === $this) {
                $coursSeq->setCours(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getNom();
    }

    /**
     * @return Collection<int, BlocCompetence>
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(BlocCompetence $competence): static
    {
        if (!$this->competences->contains($competence)) {
            $this->competences->add($competence);
        }

        return $this;
    }

    public function removeCompetence(BlocCompetence $competence): static
    {
        $this->competences->removeElement($competence);

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
            $coursDistance->setCours($this);
        }

        return $this;
    }

    public function removeCoursDistance(CoursDistance $coursDistance): static
    {
        if ($this->coursDistances->removeElement($coursDistance)) {
            // set the owning side to null (unless already changed)
            if ($coursDistance->getCours() === $this) {
                $coursDistance->setCours(null);
            }
        }

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): static
    {
        $this->matiere = $matiere;

        return $this;
    }
}
