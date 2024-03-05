<?php

namespace App\Entity;

use App\Repository\CoursDistanceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursDistanceRepository::class)]
class CoursDistance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'coursDistances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'coursDistances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cours $cours = null;

    #[ORM\ManyToOne(inversedBy: 'coursDistances')]
    private ?CoursSeq $coursSeq = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $openAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $validAt = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCours(): ?Cours
    {
        return $this->cours;
    }

    public function setCours(?Cours $cours): static
    {
        $this->cours = $cours;

        return $this;
    }

    public function getCoursSeq(): ?CoursSeq
    {
        return $this->coursSeq;
    }

    public function setCoursSeq(?CoursSeq $coursSeq): static
    {
        $this->coursSeq = $coursSeq;

        return $this;
    }

    public function getOpenAt(): ?\DateTimeImmutable
    {
        return $this->openAt;
    }

    public function setOpenAt(\DateTimeImmutable $openAt): static
    {
        $this->openAt = $openAt;

        return $this;
    }

    public function getValidAt(): ?\DateTimeImmutable
    {
        return $this->validAt;
    }

    public function setValidAt(?\DateTimeImmutable $validAt): static
    {
        $this->validAt = $validAt;

        return $this;
    }
}
