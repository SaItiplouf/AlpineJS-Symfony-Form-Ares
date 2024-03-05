<?php

namespace App\Entity;

use App\Repository\EnqueteReponseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnqueteReponseRepository::class)]
class EnqueteReponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'enqueteReponses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'enqueteReponses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Enquete $enquete = null;

    #[ORM\ManyToOne(inversedBy: 'enqueteReponses')]
    private ?EnqueteQcm $question = null;

    #[ORM\Column]
    private ?int $reponse = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

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

    public function getEnquete(): ?Enquete
    {
        return $this->enquete;
    }

    public function setEnquete(?Enquete $enquete): static
    {
        $this->enquete = $enquete;

        return $this;
    }

    public function getQuestion(): ?EnqueteQcm
    {
        return $this->question;
    }

    public function setQuestion(?EnqueteQcm $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getReponse(): ?int
    {
        return $this->reponse;
    }

    public function setReponse(int $reponse): static
    {
        $this->reponse = $reponse;

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
}
