<?php

namespace App\Entity;

use App\Repository\DevoirQcmRenduRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DevoirQcmRenduRepository::class)]
class DevoirQcmRendu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'devoirQcmRendus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'devoirQcmRendus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Devoir $devoirQcm = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'devoirQcmRendus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?DevoirQcm $questionQcm = null;

    #[ORM\Column(length: 255)]
    private ?string $reponse = null;

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

    public function getDevoirQcm(): ?Devoir
    {
        return $this->devoirQcm;
    }

    public function setDevoirQcm(?Devoir $devoirQcm): static
    {
        $this->devoirQcm = $devoirQcm;

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

    public function getQuestionQcm(): ?DevoirQcm
    {
        return $this->questionQcm;
    }

    public function setQuestionQcm(?DevoirQcm $questionQcm): static
    {
        $this->questionQcm = $questionQcm;

        return $this;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): static
    {
        $this->reponse = $reponse;

        return $this;
    }
}
