<?php

namespace App\Entity;

use App\Repository\DevoirRenduRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DevoirRenduRepository::class)]
class DevoirRendu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'devoirRendus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Devoir $devoir = null;

    #[ORM\ManyToOne(inversedBy: 'devoirRendus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $eleve = null;

    #[ORM\ManyToOne(inversedBy: 'devoirRendus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SessionFormation $promotion = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $renduAt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\ManyToMany(targetEntity: Document::class, inversedBy: 'devoirRendus')]
    private Collection $fichierRendus;

    public function __construct()
    {
        $this->fichierRendus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDevoir(): ?Devoir
    {
        return $this->devoir;
    }

    public function setDevoir(?Devoir $devoir): static
    {
        $this->devoir = $devoir;

        return $this;
    }

    public function getEleve(): ?User
    {
        return $this->eleve;
    }

    public function setEleve(?User $eleve): static
    {
        $this->eleve = $eleve;

        return $this;
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

    public function getRenduAt(): ?\DateTimeImmutable
    {
        return $this->renduAt;
    }

    public function setRenduAt(\DateTimeImmutable $renduAt): static
    {
        $this->renduAt = $renduAt;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * @return Collection<int, Document>
     */
    public function getFichierRendus(): Collection
    {
        return $this->fichierRendus;
    }

    public function addFichierRendu(Document $fichierRendu): static
    {
        if (!$this->fichierRendus->contains($fichierRendu)) {
            $this->fichierRendus->add($fichierRendu);
        }

        return $this;
    }

    public function removeFichierRendu(Document $fichierRendu): static
    {
        $this->fichierRendus->removeElement($fichierRendu);

        return $this;
    }
}
