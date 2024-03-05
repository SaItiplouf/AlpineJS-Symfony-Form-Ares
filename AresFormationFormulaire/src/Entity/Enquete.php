<?php

namespace App\Entity;

use App\Repository\EnqueteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnqueteRepository::class)]
class Enquete
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'enquetes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?DevoirT $categorie = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\OneToMany(mappedBy: 'enquete', targetEntity: EnqueteQcm::class)]
    private Collection $enqueteQcms;

    #[ORM\OneToMany(mappedBy: 'enquete', targetEntity: EnqueteReponse::class)]
    private Collection $enqueteReponses;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    public function __construct()
    {
        $this->enqueteQcms = new ArrayCollection();
        $this->enqueteReponses = new ArrayCollection();
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

    public function getCategorie(): ?DevoirT
    {
        return $this->categorie;
    }

    public function setCategorie(?DevoirT $categorie): static
    {
        $this->categorie = $categorie;

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
     * @return Collection<int, EnqueteQcm>
     */
    public function getEnqueteQcms(): Collection
    {
        return $this->enqueteQcms;
    }

    public function addEnqueteQcm(EnqueteQcm $enqueteQcm): static
    {
        if (!$this->enqueteQcms->contains($enqueteQcm)) {
            $this->enqueteQcms->add($enqueteQcm);
            $enqueteQcm->setEnquete($this);
        }

        return $this;
    }

    public function removeEnqueteQcm(EnqueteQcm $enqueteQcm): static
    {
        if ($this->enqueteQcms->removeElement($enqueteQcm)) {
            // set the owning side to null (unless already changed)
            if ($enqueteQcm->getEnquete() === $this) {
                $enqueteQcm->setEnquete(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getNom();
    }

    /**
     * @return Collection<int, EnqueteReponse>
     */
    public function getEnqueteReponses(): Collection
    {
        return $this->enqueteReponses;
    }

    public function addEnqueteReponse(EnqueteReponse $enqueteReponse): static
    {
        if (!$this->enqueteReponses->contains($enqueteReponse)) {
            $this->enqueteReponses->add($enqueteReponse);
            $enqueteReponse->setEnquete($this);
        }

        return $this;
    }

    public function removeEnqueteReponse(EnqueteReponse $enqueteReponse): static
    {
        if ($this->enqueteReponses->removeElement($enqueteReponse)) {
            // set the owning side to null (unless already changed)
            if ($enqueteReponse->getEnquete() === $this) {
                $enqueteReponse->setEnquete(null);
            }
        }

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }
}
