<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatiereRepository::class)]
class Matiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $couleur = null;

    #[ORM\ManyToMany(targetEntity: SessionFormation::class, mappedBy: 'matieres')]
    private Collection $sessionFormations;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'matieres')]
    private Collection $professeurs;

    #[ORM\OneToMany(mappedBy: 'matiere', targetEntity: Booking::class)]
    private Collection $bookings;

    #[ORM\OneToMany(mappedBy: 'matiere', targetEntity: Devoir::class)]
    private Collection $devoirs;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $couleurTexte = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code = null;

    #[ORM\OneToMany(mappedBy: 'matiere', targetEntity: IntituleTechnique::class)]
    private Collection $intituleTechniques;

    #[ORM\OneToMany(mappedBy: 'matiere', targetEntity: Cours::class)]
    private Collection $cours;

    public function __construct()
    {
        $this->sessionFormations = new ArrayCollection();
        $this->professeurs = new ArrayCollection();
        $this->bookings = new ArrayCollection();
        $this->devoirs = new ArrayCollection();
        $this->intituleTechniques = new ArrayCollection();
        $this->cours = new ArrayCollection();
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

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): static
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * @return Collection<int, SessionFormation>
     */
    public function getSessionFormations(): Collection
    {
        return $this->sessionFormations;
    }

    public function addSessionFormation(SessionFormation $sessionFormation): static
    {
        if (!$this->sessionFormations->contains($sessionFormation)) {
            $this->sessionFormations->add($sessionFormation);
            $sessionFormation->addMatiere($this);
        }

        return $this;
    }

    public function removeSessionFormation(SessionFormation $sessionFormation): static
    {
        if ($this->sessionFormations->removeElement($sessionFormation)) {
            $sessionFormation->removeMatiere($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getProfesseurs(): Collection
    {
        return $this->professeurs;
    }

    public function addProfesseur(User $professeur): static
    {
        if (!$this->professeurs->contains($professeur)) {
            $this->professeurs->add($professeur);
            $professeur->addMatiere($this);
        }

        return $this;
    }

    public function removeProfesseur(User $professeur): static
    {
        if ($this->professeurs->removeElement($professeur)) {
            $professeur->removeMatiere($this);
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getNom();
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): static
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings->add($booking);
            $booking->setMatiere($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): static
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getMatiere() === $this) {
                $booking->setMatiere(null);
            }
        }

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
            $devoir->setMatiere($this);
        }

        return $this;
    }

    public function removeDevoir(Devoir $devoir): static
    {
        if ($this->devoirs->removeElement($devoir)) {
            // set the owning side to null (unless already changed)
            if ($devoir->getMatiere() === $this) {
                $devoir->setMatiere(null);
            }
        }

        return $this;
    }

    public function getCouleurTexte(): ?string
    {
        return $this->couleurTexte;
    }

    public function setCouleurTexte(?string $couleurTexte): static
    {
        $this->couleurTexte = $couleurTexte;

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

    /**
     * @return Collection<int, IntituleTechnique>
     */
    public function getIntituleTechniques(): Collection
    {
        return $this->intituleTechniques;
    }

    public function addIntituleTechnique(IntituleTechnique $intituleTechnique): static
    {
        if (!$this->intituleTechniques->contains($intituleTechnique)) {
            $this->intituleTechniques->add($intituleTechnique);
            $intituleTechnique->setMatiere($this);
        }

        return $this;
    }

    public function removeIntituleTechnique(IntituleTechnique $intituleTechnique): static
    {
        if ($this->intituleTechniques->removeElement($intituleTechnique)) {
            // set the owning side to null (unless already changed)
            if ($intituleTechnique->getMatiere() === $this) {
                $intituleTechnique->setMatiere(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): static
    {
        if (!$this->cours->contains($cour)) {
            $this->cours->add($cour);
            $cour->setMatiere($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): static
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getMatiere() === $this) {
                $cour->setMatiere(null);
            }
        }

        return $this;
    }
}
