<?php

namespace App\Entity;

use App\Repository\EntrepriseDossierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseDossierRepository::class)]
class EntrepriseDossier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'entrepriseDossiers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Entreprise $entreprise = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'entrepriseDossiers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'dossier', targetEntity: EntrepriseNote::class)]
    private Collection $entrepriseNotes;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateEnd = null;

    #[ORM\ManyToOne(inversedBy: 'entrepriseDossiers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Etat $etat = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->entrepriseNotes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): static
    {
        $this->entreprise = $entreprise;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, EntrepriseNote>
     */
    public function getEntrepriseNotes(): Collection
    {
        return $this->entrepriseNotes;
    }

    public function addEntrepriseNote(EntrepriseNote $entrepriseNote): static
    {
        if (!$this->entrepriseNotes->contains($entrepriseNote)) {
            $this->entrepriseNotes->add($entrepriseNote);
            $entrepriseNote->setDossier($this);
        }

        return $this;
    }

    public function removeEntrepriseNote(EntrepriseNote $entrepriseNote): static
    {
        if ($this->entrepriseNotes->removeElement($entrepriseNote)) {
            // set the owning side to null (unless already changed)
            if ($entrepriseNote->getDossier() === $this) {
                $entrepriseNote->setDossier(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getNom();
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTimeInterface $dateEnd): static
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getEtat(): ?Etat
    {
        return $this->etat;
    }

    public function setEtat(?Etat $etat): static
    {
        $this->etat = $etat;

        return $this;
    }
}
