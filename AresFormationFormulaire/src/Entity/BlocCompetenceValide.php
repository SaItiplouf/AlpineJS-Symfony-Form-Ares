<?php

namespace App\Entity;

use App\Repository\BlocCompetenceValideRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlocCompetenceValideRepository::class)]
class BlocCompetenceValide
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'blocCompetenceValides')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SessionFormation $promotion = null;

    #[ORM\ManyToOne(inversedBy: 'blocCompetenceValides')]
    #[ORM\JoinColumn(nullable: false)]
    private ?BlocCompetence $competence = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'blocCompetenceValides')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $prof = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPromotion(): ?SessionFormation
    {
        return $this->promotion;
    }

    public function setPromotion(?SessionFormation $promotion): static
    {
        $this->promotion = $promotion;

        return $this;
    }

    public function getCompetence(): ?BlocCompetence
    {
        return $this->competence;
    }

    public function setCompetence(?BlocCompetence $competence): static
    {
        $this->competence = $competence;

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

    public function getProf(): ?User
    {
        return $this->prof;
    }

    public function setProf(?User $prof): static
    {
        $this->prof = $prof;

        return $this;
    }
}
