<?php

namespace App\Entity;

use App\Repository\DevoirTRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DevoirTRepository::class)]
class DevoirT
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: Devoir::class)]
    private Collection $devoirs;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Enquete::class)]
    private Collection $enquetes;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code = null;

    public function __construct()
    {
        $this->devoirs = new ArrayCollection();
        $this->enquetes = new ArrayCollection();
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

    /**
     * @return Collection<int, Devoir>
     */
    public function getDevoirs(): Collection
    {
        return $this->devoirs;
    }

    public function addDevoir(Devoir $devoir): static
    {
        if (!$this->devoirs->contains($devoir)) {
            $this->devoirs->add($devoir);
            $devoir->setType($this);
        }

        return $this;
    }

    public function removeDevoir(Devoir $devoir): static
    {
        if ($this->devoirs->removeElement($devoir)) {
            // set the owning side to null (unless already changed)
            if ($devoir->getType() === $this) {
                $devoir->setType(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getNom();
    }

    /**
     * @return Collection<int, Enquete>
     */
    public function getEnquetes(): Collection
    {
        return $this->enquetes;
    }

    public function addEnquete(Enquete $enquete): static
    {
        if (!$this->enquetes->contains($enquete)) {
            $this->enquetes->add($enquete);
            $enquete->setCategorie($this);
        }

        return $this;
    }

    public function removeEnquete(Enquete $enquete): static
    {
        if ($this->enquetes->removeElement($enquete)) {
            // set the owning side to null (unless already changed)
            if ($enquete->getCategorie() === $this) {
                $enquete->setCategorie(null);
            }
        }

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): static
    {
        $this->code = $code;

        return $this;
    }
}
