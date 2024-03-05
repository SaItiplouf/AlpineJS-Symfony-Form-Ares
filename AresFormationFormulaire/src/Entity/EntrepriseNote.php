<?php

namespace App\Entity;

use App\Repository\EntrepriseNoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseNoteRepository::class)]
class EntrepriseNote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'entrepriseNotes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'entrepriseNotes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?EntrepriseDossier $dossier = null;

    #[ORM\Column(length: 255)]
    private ?string $typeNote = null;


    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();

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

    public function getDossier(): ?EntrepriseDossier
    {
        return $this->dossier;
    }

    public function setDossier(?EntrepriseDossier $dossier): static
    {
        $this->dossier = $dossier;

        return $this;
    }
    public function __toString(): string
    {
        return $this->getNom();
    }

    public function getTypeNote(): ?string
    {
        return $this->typeNote;
    }

    public function setTypeNote(string $typeNote): static
    {
        $this->typeNote = $typeNote;

        return $this;
    }
}
