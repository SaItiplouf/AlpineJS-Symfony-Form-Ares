<?php

namespace App\Entity;

use App\Repository\EtatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtatRepository::class)]
class Etat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'etat', targetEntity: EntrepriseDossier::class)]
    private Collection $entrepriseDossiers;

    public function __construct()
    {
        $this->entrepriseDossiers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection<int, EntrepriseDossier>
     */
    public function getEntrepriseDossiers(): Collection
    {
        return $this->entrepriseDossiers;
    }

    public function addEntrepriseDossier(EntrepriseDossier $entrepriseDossier): static
    {
        if (!$this->entrepriseDossiers->contains($entrepriseDossier)) {
            $this->entrepriseDossiers->add($entrepriseDossier);
            $entrepriseDossier->setEtat($this);
        }

        return $this;
    }

    public function removeEntrepriseDossier(EntrepriseDossier $entrepriseDossier): static
    {
        if ($this->entrepriseDossiers->removeElement($entrepriseDossier)) {
            // set the owning side to null (unless already changed)
            if ($entrepriseDossier->getEtat() === $this) {
                $entrepriseDossier->setEtat(null);
            }
        }

        return $this;
    }
}
