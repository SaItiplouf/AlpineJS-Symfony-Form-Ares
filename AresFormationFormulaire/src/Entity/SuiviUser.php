<?php

namespace App\Entity;

use App\Repository\SuiviUserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SuiviUserRepository::class)]
class SuiviUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateSuivi = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenu = null;

    #[ORM\Column]
    private ?bool $isVisible = null;



    #[ORM\Column]
    private ?bool $isChangementStatut = null;

    #[ORM\ManyToOne(inversedBy: 'suiviUserRediges')]
    private ?User $redacteur = null;

    #[ORM\ManyToOne(inversedBy: 'suiviUserConcernes')]
    private ?User $concerne = null;

    #[ORM\ManyToOne(inversedBy: 'suiviUsers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SuiviCategory $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateSuivi(): ?\DateTimeInterface
    {
        return $this->dateSuivi;
    }

    public function setDateSuivi(\DateTimeInterface $dateSuivi): static
    {
        $this->dateSuivi = $dateSuivi;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function isIsVisible(): ?bool
    {
        return $this->isVisible;
    }

    public function setIsVisible(bool $isVisible): static
    {
        $this->isVisible = $isVisible;

        return $this;
    }

    public function isIsChangementStatut(): ?bool
    {
        return $this->isChangementStatut;
    }

    public function setIsChangementStatut(bool $isChangementStatut): static
    {
        $this->isChangementStatut = $isChangementStatut;

        return $this;
    }

    public function getRedacteur(): ?User
    {
        return $this->redacteur;
    }

    public function setRedacteur(?User $redacteur): static
    {
        $this->redacteur = $redacteur;

        return $this;
    }

    public function getConcerne(): ?User
    {
        return $this->concerne;
    }

    public function setConcerne(?User $concerne): static
    {
        $this->concerne = $concerne;

        return $this;
    }
    public function __toString(): string
    {
        return $this->getContenu();
    }

    public function getCategory(): ?SuiviCategory
    {
        return $this->category;
    }

    public function setCategory(?SuiviCategory $category): static
    {
        $this->category = $category;

        return $this;
    }
}
