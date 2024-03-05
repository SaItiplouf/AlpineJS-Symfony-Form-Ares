<?php

namespace App\Entity;

use App\Repository\LocalisationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocalisationRepository::class)]
class Localisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cp = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ville = null;

    #[ORM\Column]
    private ?int $etage = null;

    #[ORM\OneToMany(mappedBy: 'localisation', targetEntity: Salle::class)]
    private Collection $salles;

    #[ORM\ManyToOne(inversedBy: 'localisations')]
    private ?Batiment $batiment = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code = null;

    public function __construct()
    {
        $this->salles = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(?string $cp): static
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getEtage(): ?int
    {
        return $this->etage;
    }

    public function setEtage(int $etage): static
    {
        $this->etage = $etage;

        return $this;
    }

    /**
     * @return Collection<int, Salle>
     */
    public function getSalles(): Collection
    {
        return $this->salles;
    }

    public function addSalle(Salle $salle): static
    {
        if (!$this->salles->contains($salle)) {
            $this->salles->add($salle);
            $salle->setLocalisation($this);
        }

        return $this;
    }

    public function removeSalle(Salle $salle): static
    {
        if ($this->salles->removeElement($salle)) {
            // set the owning side to null (unless already changed)
            if ($salle->getLocalisation() === $this) {
                $salle->setLocalisation(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        $adresse = (!is_null($this->adresse)) ? $this->adresse : '';
        $cp = (!is_null($this->cp) && !empty($adresse)) ? ', ' . $this->cp :
            ((!is_null($this->cp)) ? $this->cp : '');
        $ville = (!empty($adresse) && !empty($cp) && !is_null($this->ville)) ? ' ' . $this->ville :
                ((!empty($adresse) && empty($cp) && !is_null($this->ville)) ? ', ' . $this->ville :
                ((!is_null($this->ville)) ? $this->ville : ''));
        return $this->batiment . ' - ' . $this->nom . '(Etage : ' . strval($this->etage) .')' . ((!empty($adresse) || !empty($cp) || !empty($ville)) ? ' - ' . $adresse . $cp . $ville : '');
    }

    public function getBatiment(): ?Batiment
    {
        return $this->batiment;
    }

    public function setBatiment(?Batiment $batiment): static
    {
        $this->batiment = $batiment;

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
