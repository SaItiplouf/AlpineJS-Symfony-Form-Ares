<?php

namespace App\Entity;

use App\Repository\SessionFormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionFormationRepository::class)]
class SessionFormation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(nullable: true)]
    private ?int $dureeStage = null;

    #[ORM\Column(nullable: true)]
    private ?float $satisfaction = null;

    #[ORM\Column(nullable: true)]
    private ?float $abandon = null;

    #[ORM\Column(nullable: true)]
    private ?float $reussite = null;

    #[ORM\Column]
    private ?bool $isArchive = null;

    #[ORM\ManyToOne(inversedBy: 'sessionFormations')]
    private ?Formation $formation = null;

    #[ORM\ManyToOne(inversedBy: 'sessionFormations')]
    private ?User $professeurReferent = null;

    #[ORM\ManyToMany(targetEntity: Matiere::class, inversedBy: 'sessionFormations')]
    private Collection $matieres;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'sessionSuivies')]
    private Collection $apprenants;

    #[ORM\OneToMany(mappedBy: 'promotion', targetEntity: Devoir::class)]
    private Collection $devoirs;

    #[ORM\ManyToMany(targetEntity: Cours::class, mappedBy: 'promotion')]
    private Collection $cours;

    #[ORM\OneToMany(mappedBy: 'promotion', targetEntity: BlocCompetenceValide::class)]
    private Collection $blocCompetenceValides;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomPromotion = null;

    #[ORM\Column(length: 20)]
    private ?string $annee = null;

    #[ORM\OneToMany(mappedBy: 'promotion', targetEntity: Liaison::class)]
    private Collection $liaisons;

    #[ORM\OneToMany(mappedBy: 'promotion', targetEntity: DevoirRendu::class, orphanRemoval: true)]
    private Collection $devoirRendus;

    #[ORM\OneToMany(mappedBy: 'promotion', targetEntity: Booking::class)]
    private Collection $bookings;




    public function __construct()
    {
        $this->matieres = new ArrayCollection();
        $this->apprenants = new ArrayCollection();
        $this->devoirs = new ArrayCollection();
        $this->cours = new ArrayCollection();
        $this->blocCompetenceValides = new ArrayCollection();
        $this->liaisons = new ArrayCollection();
        $this->devoirRendus = new ArrayCollection();
        $this->bookings = new ArrayCollection();
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

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getDureeStage(): ?int
    {
        return $this->dureeStage;
    }

    public function setDureeStage(?int $dureeStage): static
    {
        $this->dureeStage = $dureeStage;

        return $this;
    }

    public function getSatisfaction(): ?float
    {
        return $this->satisfaction;
    }

    public function setSatisfaction(?float $satisfaction): static
    {
        $this->satisfaction = $satisfaction;

        return $this;
    }

    public function getAbandon(): ?float
    {
        return $this->abandon;
    }

    public function setAbandon(?float $abandon): static
    {
        $this->abandon = $abandon;

        return $this;
    }

    public function getReussite(): ?float
    {
        return $this->reussite;
    }

    public function setReussite(?float $reussite): static
    {
        $this->reussite = $reussite;

        return $this;
    }

    public function isIsArchive(): ?bool
    {
        return $this->isArchive;
    }

    public function setIsArchive(bool $isArchive): static
    {
        $this->isArchive = $isArchive;

        return $this;
    }

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $formation): static
    {
        $this->formation = $formation;

        return $this;
    }

    public function getProfesseurReferent(): ?User
    {
        return $this->professeurReferent;
    }

    public function setProfesseurReferent(?User $professeurReferent): static
    {
        $this->professeurReferent = $professeurReferent;

        return $this;
    }

    /**
     * @return Collection<int, Matiere>
     */
    public function getMatieres(): Collection
    {
        return $this->matieres;
    }

    public function addMatiere(Matiere $matiere): static
    {
        if (!$this->matieres->contains($matiere)) {
            $this->matieres->add($matiere);
        }

        return $this;
    }

    public function removeMatiere(Matiere $matiere): static
    {
        $this->matieres->removeElement($matiere);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getApprenants(): Collection
    {
        return $this->apprenants;
    }

    public function addApprenant(User $apprenant): static
    {
        if (!$this->apprenants->contains($apprenant)) {
            $this->apprenants->add($apprenant);
            $apprenant->addSessionSuivy($this);
        }

        return $this;
    }

    public function removeApprenant(User $apprenant): static
    {
        if ($this->apprenants->removeElement($apprenant)) {
            $apprenant->removeSessionSuivy($this);
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getNom();
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
            $devoir->setPromotion($this);
        }

        return $this;
    }

    public function removeDevoir(Devoir $devoir): static
    {
        if ($this->devoirs->removeElement($devoir)) {
            // set the owning side to null (unless already changed)
            if ($devoir->getPromotion() === $this) {
                $devoir->setPromotion(null);
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
            $cour->addPromotion($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): static
    {
        if ($this->cours->removeElement($cour)) {
            $cour->removePromotion($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, BlocCompetenceValide>
     */
    public function getBlocCompetenceValides(): Collection
    {
        return $this->blocCompetenceValides;
    }

    public function addBlocCompetenceValide(BlocCompetenceValide $blocCompetenceValide): static
    {
        if (!$this->blocCompetenceValides->contains($blocCompetenceValide)) {
            $this->blocCompetenceValides->add($blocCompetenceValide);
            $blocCompetenceValide->setPromotion($this);
        }

        return $this;
    }

    public function removeBlocCompetenceValide(BlocCompetenceValide $blocCompetenceValide): static
    {
        if ($this->blocCompetenceValides->removeElement($blocCompetenceValide)) {
            // set the owning side to null (unless already changed)
            if ($blocCompetenceValide->getPromotion() === $this) {
                $blocCompetenceValide->setPromotion(null);
            }
        }

        return $this;
    }

    public function getNomPromotion(): ?string
    {
        return $this->nomPromotion;
    }

    public function setNomPromotion(?string $nomPromotion): static
    {
        $this->nomPromotion = $nomPromotion;

        return $this;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(string $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * @return Collection<int, Liaison>
     */
    public function getLiaisons(): Collection
    {
        return $this->liaisons;
    }

    public function addLiaison(Liaison $liaison): static
    {
        if (!$this->liaisons->contains($liaison)) {
            $this->liaisons->add($liaison);
            $liaison->setPromotion($this);
        }

        return $this;
    }

    public function removeLiaison(Liaison $liaison): static
    {
        if ($this->liaisons->removeElement($liaison)) {
            // set the owning side to null (unless already changed)
            if ($liaison->getPromotion() === $this) {
                $liaison->setPromotion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DevoirRendu>
     */
    public function getDevoirRendus(): Collection
    {
        return $this->devoirRendus;
    }

    public function addDevoirRendu(DevoirRendu $devoirRendu): static
    {
        if (!$this->devoirRendus->contains($devoirRendu)) {
            $this->devoirRendus->add($devoirRendu);
            $devoirRendu->setPromotion($this);
        }

        return $this;
    }

    public function removeDevoirRendu(DevoirRendu $devoirRendu): static
    {
        if ($this->devoirRendus->removeElement($devoirRendu)) {
            // set the owning side to null (unless already changed)
            if ($devoirRendu->getPromotion() === $this) {
                $devoirRendu->setPromotion(null);
            }
        }

        return $this;
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
            $booking->setProf($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): static
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getProf() === $this) {
                $booking->setProf(null);
            }
        }

        return $this;
    }


}
