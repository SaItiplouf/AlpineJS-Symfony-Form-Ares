<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    // Les sessions pour lesquelles l'utilisateur est le professeur référent
    #[ORM\OneToMany(mappedBy: 'professeurReferent', targetEntity: SessionFormation::class)]
    private Collection $sessionFormations;

    #[ORM\OneToMany(mappedBy: 'redacteur', targetEntity: SuiviUser::class)]
    private Collection $suiviUserRediges;

    #[ORM\OneToMany(mappedBy: 'concerne', targetEntity: SuiviUser::class)]
    private Collection $suiviUserConcernes;

    #[ORM\ManyToMany(targetEntity: GroupeDroit::class, inversedBy: 'users', cascade: ['persist', 'remove'])]
    private Collection $droits;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'apprenants')]
    private ?self $tuteur = null;

    #[ORM\OneToMany(mappedBy: 'tuteur', targetEntity: self::class)]
    private Collection $apprenants;
/*
    #[ORM\OneToOne(inversedBy: 'utilisateur', cascade: ['persist', 'remove'])]
    private ?Profil $profil = null;
*/

    #[ORM\ManyToMany(targetEntity: Matiere::class, inversedBy: 'professeurs')]
    private Collection $matieres;

    // Récupérer les sessions pour lesquelles le candidat est inscrit
    #[ORM\ManyToMany(targetEntity: SessionFormation::class, inversedBy: 'apprenants')]
    private Collection $sessionSuivies;


    #[ORM\OneToMany(mappedBy: 'prof', targetEntity: Booking::class)]
    private Collection $bookings;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Entreprise::class)]
    private Collection $entreprises;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: EntrepriseDossier::class)]
    private Collection $entrepriseDossiers;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: EntrepriseNote::class)]
    private Collection $entrepriseNotes;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\OneToMany(mappedBy: 'createur', targetEntity: Devoir::class)]
    private Collection $devoirs;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: DevoirNote::class)]
    private Collection $devoirNotes;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: EnqueteReponse::class)]
    private Collection $enqueteReponses;

    #[ORM\OneToMany(mappedBy: 'createur', targetEntity: Ticket::class)]
    private Collection $tickets;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Absence::class)]
    private Collection $absences;

    #[ORM\OneToMany(mappedBy: 'createur', targetEntity: Cours::class)]
    private Collection $cours;

    #[ORM\OneToMany(mappedBy: 'createur', targetEntity: CoursSeq::class)]
    private Collection $coursSeqs;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: ValidDoc::class)]
    private Collection $validDocs;

    #[ORM\OneToMany(mappedBy: 'prof', targetEntity: BlocCompetenceValide::class)]
    private Collection $blocCompetenceValides;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Contrat $contrat = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Provenance $provenance = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Structure $structure = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $tel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $cp = null;

    #[ORM\Column(length: 40, nullable: true)]
    private ?string $ville = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $numPoleEmploi = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $numSecu = null;

    #[ORM\Column(nullable: true)]
    private ?int $montantCpf = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $dernierDiplome = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $dernierEmploi = null;

    #[ORM\Column]
    private ?bool $isHandicap = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rqHandicap = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rqGenerale = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $attestationAt = null;

    #[ORM\Column]
    private ?bool $isDroitImage = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $attestationDroitImageAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rqUser = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Niveau $niveau = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $reglementAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $entretienAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $testAt = null;

    #[ORM\Column(nullable: true)]
    private ?float $resultatTest = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Document $dossier = null;

    #[ORM\ManyToOne(inversedBy: 'usersCv')]
    private ?Document $cv = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $decision = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $decisionAt = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Rythme $rythme = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Log::class, orphanRemoval: true)]
    private Collection $logs;

    #[ORM\OneToMany(mappedBy: 'prof', targetEntity: Liaison::class)]
    private Collection $liaisons;

    #[ORM\OneToMany(mappedBy: 'eleve', targetEntity: DevoirRendu::class)]
    private Collection $devoirRendus;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: DevoirQcmRendu::class)]
    private Collection $devoirQcmRendus;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: CoursDistance::class)]
    private Collection $coursDistances;

    /*#[ORM\ManyToMany(targetEntity: SessionFormation::class, inversedBy: 'profs')]
    private Collection $enseignePromotion;*/



    public function __construct()
    {
        $this->sessionFormations = new ArrayCollection();
        $this->suiviUserRediges = new ArrayCollection();
        $this->suiviUserConcernes = new ArrayCollection();
        $this->droits = new ArrayCollection();
        $this->apprenants = new ArrayCollection();
        $this->matieres = new ArrayCollection();
        $this->sessionSuivies = new ArrayCollection();
        $this->bookings = new ArrayCollection();
        $this->entreprises = new ArrayCollection();
        $this->entrepriseDossiers = new ArrayCollection();
        $this->entrepriseNotes = new ArrayCollection();
        $this->devoirs = new ArrayCollection();
        $this->devoirNotes = new ArrayCollection();
        $this->enqueteReponses = new ArrayCollection();
        $this->tickets = new ArrayCollection();
        $this->absences = new ArrayCollection();
        $this->cours = new ArrayCollection();
        $this->coursSeqs = new ArrayCollection();
        $this->validDocs = new ArrayCollection();
        $this->blocCompetenceValides = new ArrayCollection();
        $this->logs = new ArrayCollection();
        $this->liaisons = new ArrayCollection();
        $this->devoirRendus = new ArrayCollection();
        $this->devoirQcmRendus = new ArrayCollection();
        $this->coursDistances = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

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
            $sessionFormation->setProfesseurReferent($this);
        }

        return $this;
    }

    public function removeSessionFormation(SessionFormation $sessionFormation): static
    {
        if ($this->sessionFormations->removeElement($sessionFormation)) {
            // set the owning side to null (unless already changed)
            if ($sessionFormation->getProfesseurReferent() === $this) {
                $sessionFormation->setProfesseurReferent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SuiviUser>
     */
    public function getSuiviUserRediges(): Collection
    {
        return $this->suiviUserRediges;
    }

    public function addSuiviUserRedige(SuiviUser $suiviUserRedige): static
    {
        if (!$this->suiviUserRediges->contains($suiviUserRedige)) {
            $this->suiviUserRediges->add($suiviUserRedige);
            $suiviUserRedige->setRedacteur($this);
        }

        return $this;
    }

    public function removeSuiviUserRedige(SuiviUser $suiviUserRedige): static
    {
        if ($this->suiviUserRediges->removeElement($suiviUserRedige)) {
            // set the owning side to null (unless already changed)
            if ($suiviUserRedige->getRedacteur() === $this) {
                $suiviUserRedige->setRedacteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SuiviUser>
     */
    public function getSuiviUserConcernes(): Collection
    {
        return $this->suiviUserConcernes;
    }

    public function addSuiviUserConcerne(SuiviUser $suiviUserConcerne): static
    {
        if (!$this->suiviUserConcernes->contains($suiviUserConcerne)) {
            $this->suiviUserConcernes->add($suiviUserConcerne);
            $suiviUserConcerne->setConcerne($this);
        }

        return $this;
    }

    public function removeSuiviUserConcerne(SuiviUser $suiviUserConcerne): static
    {
        if ($this->suiviUserConcernes->removeElement($suiviUserConcerne)) {
            // set the owning side to null (unless already changed)
            if ($suiviUserConcerne->getConcerne() === $this) {
                $suiviUserConcerne->setConcerne(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GroupeDroit>
     */
    public function getDroits(): Collection
    {
        return $this->droits;
    }

    public function addDroit(GroupeDroit $droit): static
    {
        if (!$this->droits->contains($droit)) {
            $this->droits->add($droit);
        }

        return $this;
    }

    public function removeDroit(GroupeDroit $droit): static
    {
        $this->droits->removeElement($droit);

        return $this;
    }

    public function getTuteur(): ?self
    {
        return $this->tuteur;
    }

    public function setTuteur(?self $tuteur): static
    {
        $this->tuteur = $tuteur;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getApprenants(): Collection
    {
        return $this->apprenants;
    }

    public function addApprenant(self $apprenant): static
    {
        if (!$this->apprenants->contains($apprenant)) {
            $this->apprenants->add($apprenant);
            $apprenant->setTuteur($this);
        }

        return $this;
    }

    public function removeApprenant(self $apprenant): static
    {
        if ($this->apprenants->removeElement($apprenant)) {
            // set the owning side to null (unless already changed)
            if ($apprenant->getTuteur() === $this) {
                $apprenant->setTuteur(null);
            }
        }

        return $this;
    }
/*
    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): static
    {
        $this->profil = $profil;

        return $this;
    }
*/

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
     * @return Collection<int, SessionFormation>
     */
    public function getSessionSuivies(): Collection
    {
        return $this->sessionSuivies;
    }

    public function addSessionSuivy(SessionFormation $sessionSuivy): static
    {
        if (!$this->sessionSuivies->contains($sessionSuivy)) {
            $this->sessionSuivies->add($sessionSuivy);
        }

        return $this;
    }

    public function removeSessionSuivy(SessionFormation $sessionSuivy): static
    {
        $this->sessionSuivies->removeElement($sessionSuivy);

        return $this;
    }
    public function __toString(): string
    {
        return $this->getPrenom().' '.$this->getNom();
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

    /**
     * @return Collection<int, Entreprise>
     */
    public function getEntreprises(): Collection
    {
        return $this->entreprises;
    }

    public function addEntreprise(Entreprise $entreprise): static
    {
        if (!$this->entreprises->contains($entreprise)) {
            $this->entreprises->add($entreprise);
            $entreprise->setUser($this);
        }

        return $this;
    }

    public function removeEntreprise(Entreprise $entreprise): static
    {
        if ($this->entreprises->removeElement($entreprise)) {
            // set the owning side to null (unless already changed)
            if ($entreprise->getUser() === $this) {
                $entreprise->setUser(null);
            }
        }

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
            $entrepriseDossier->setUser($this);
        }

        return $this;
    }

    public function removeEntrepriseDossier(EntrepriseDossier $entrepriseDossier): static
    {
        if ($this->entrepriseDossiers->removeElement($entrepriseDossier)) {
            // set the owning side to null (unless already changed)
            if ($entrepriseDossier->getUser() === $this) {
                $entrepriseDossier->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EntrepriseNote>
     */
    public function getEntrepriseNotes(): Collection
    {
        return $this->entrepriseNotes;
    }

    public function addEntrepriseNote(EntrepriseNote $entrepriseNote): static
    {
        if (!$this->entrepriseNotes->contains($entrepriseNote)) {
            $this->entrepriseNotes->add($entrepriseNote);
            $entrepriseNote->setUser($this);
        }

        return $this;
    }

    public function removeEntrepriseNote(EntrepriseNote $entrepriseNote): static
    {
        if ($this->entrepriseNotes->removeElement($entrepriseNote)) {
            // set the owning side to null (unless already changed)
            if ($entrepriseNote->getUser() === $this) {
                $entrepriseNote->setUser(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

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
            $devoir->setCreateur($this);
        }

        return $this;
    }

    public function removeDevoir(Devoir $devoir): static
    {
        if ($this->devoirs->removeElement($devoir)) {
            // set the owning side to null (unless already changed)
            if ($devoir->getCreateur() === $this) {
                $devoir->setCreateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DevoirNote>
     */
    public function getDevoirNotes(): Collection
    {
        return $this->devoirNotes;
    }

    public function addDevoirNote(DevoirNote $devoirNote): static
    {
        if (!$this->devoirNotes->contains($devoirNote)) {
            $this->devoirNotes->add($devoirNote);
            $devoirNote->setUser($this);
        }

        return $this;
    }

    public function removeDevoirNote(DevoirNote $devoirNote): static
    {
        if ($this->devoirNotes->removeElement($devoirNote)) {
            // set the owning side to null (unless already changed)
            if ($devoirNote->getUser() === $this) {
                $devoirNote->setUser(null);
            }
        }

        return $this;
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
            $enqueteReponse->setUser($this);
        }

        return $this;
    }

    public function removeEnqueteReponse(EnqueteReponse $enqueteReponse): static
    {
        if ($this->enqueteReponses->removeElement($enqueteReponse)) {
            // set the owning side to null (unless already changed)
            if ($enqueteReponse->getUser() === $this) {
                $enqueteReponse->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ticket>
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): static
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets->add($ticket);
            $ticket->setCreateur($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): static
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getCreateur() === $this) {
                $ticket->setCreateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Absence>
     */
    public function getAbsences(): Collection
    {
        return $this->absences;
    }

    public function addAbsence(Absence $absence): static
    {
        if (!$this->absences->contains($absence)) {
            $this->absences->add($absence);
            $absence->setUser($this);
        }

        return $this;
    }

    public function removeAbsence(Absence $absence): static
    {
        if ($this->absences->removeElement($absence)) {
            // set the owning side to null (unless already changed)
            if ($absence->getUser() === $this) {
                $absence->setUser(null);
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
            $cour->setCreateur($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): static
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getCreateur() === $this) {
                $cour->setCreateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CoursSeq>
     */
    public function getCoursSeqs(): Collection
    {
        return $this->coursSeqs;
    }

    public function addCoursSeq(CoursSeq $coursSeq): static
    {
        if (!$this->coursSeqs->contains($coursSeq)) {
            $this->coursSeqs->add($coursSeq);
            $coursSeq->setCreateur($this);
        }

        return $this;
    }

    public function removeCoursSeq(CoursSeq $coursSeq): static
    {
        if ($this->coursSeqs->removeElement($coursSeq)) {
            // set the owning side to null (unless already changed)
            if ($coursSeq->getCreateur() === $this) {
                $coursSeq->setCreateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ValidDoc>
     */
    public function getValidDocs(): Collection
    {
        return $this->validDocs;
    }

    public function addValidDoc(ValidDoc $validDoc): static
    {
        if (!$this->validDocs->contains($validDoc)) {
            $this->validDocs->add($validDoc);
            $validDoc->setUser($this);
        }

        return $this;
    }

    public function removeValidDoc(ValidDoc $validDoc): static
    {
        if ($this->validDocs->removeElement($validDoc)) {
            // set the owning side to null (unless already changed)
            if ($validDoc->getUser() === $this) {
                $validDoc->setUser(null);
            }
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
            $blocCompetenceValide->setProf($this);
        }

        return $this;
    }

    public function removeBlocCompetenceValide(BlocCompetenceValide $blocCompetenceValide): static
    {
        if ($this->blocCompetenceValides->removeElement($blocCompetenceValide)) {
            // set the owning side to null (unless already changed)
            if ($blocCompetenceValide->getProf() === $this) {
                $blocCompetenceValide->setProf(null);
            }
        }

        return $this;
    }

    public function getContrat(): ?Contrat
    {
        return $this->contrat;
    }

    public function setContrat(?Contrat $contrat): static
    {
        $this->contrat = $contrat;

        return $this;
    }

    public function getProvenance(): ?Provenance
    {
        return $this->provenance;
    }

    public function setProvenance(?Provenance $provenance): static
    {
        $this->provenance = $provenance;

        return $this;
    }

    public function getStructure(): ?Structure
    {
        return $this->structure;
    }

    public function setStructure(?Structure $structure): static
    {
        $this->structure = $structure;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(?\DateTimeInterface $dateNaissance): static
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): static
    {
        $this->tel = $tel;

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

    public function getNumPoleEmploi(): ?string
    {
        return $this->numPoleEmploi;
    }

    public function setNumPoleEmploi(?string $numPoleEmploi): static
    {
        $this->numPoleEmploi = $numPoleEmploi;

        return $this;
    }

    public function getNumSecu(): ?string
    {
        return $this->numSecu;
    }

    public function setNumSecu(?string $numSecu): static
    {
        $this->numSecu = $numSecu;

        return $this;
    }

    public function getMontantCpf(): ?int
    {
        return $this->montantCpf;
    }

    public function setMontantCpf(?int $montantCpf): static
    {
        $this->montantCpf = $montantCpf;

        return $this;
    }

    public function getDernierDiplome(): ?string
    {
        return $this->dernierDiplome;
    }

    public function setDernierDiplome(?string $dernierDiplome): static
    {
        $this->dernierDiplome = $dernierDiplome;

        return $this;
    }

    public function getDernierEmploi(): ?string
    {
        return $this->dernierEmploi;
    }

    public function setDernierEmploi(?string $dernierEmploi): static
    {
        $this->dernierEmploi = $dernierEmploi;

        return $this;
    }

    public function isIsHandicap(): ?bool
    {
        return $this->isHandicap;
    }

    public function setIsHandicap(bool $isHandicap): static
    {
        $this->isHandicap = $isHandicap;

        return $this;
    }

    public function getRqHandicap(): ?string
    {
        return $this->rqHandicap;
    }

    public function setRqHandicap(?string $rqHandicap): static
    {
        $this->rqHandicap = $rqHandicap;

        return $this;
    }

    public function getRqGenerale(): ?string
    {
        return $this->rqGenerale;
    }

    public function setRqGenerale(?string $rqGenerale): static
    {
        $this->rqGenerale = $rqGenerale;

        return $this;
    }

    public function getAttestationAt(): ?\DateTimeImmutable
    {
        return $this->attestationAt;
    }

    public function setAttestationAt(?\DateTimeImmutable $attestationAt): static
    {
        $this->attestationAt = $attestationAt;

        return $this;
    }

    public function isIsDroitImage(): ?bool
    {
        return $this->isDroitImage;
    }

    public function setIsDroitImage(bool $isDroitImage): static
    {
        $this->isDroitImage = $isDroitImage;

        return $this;
    }

    public function getAttestationDroitImageAt(): ?\DateTimeImmutable
    {
        return $this->attestationDroitImageAt;
    }

    public function setAttestationDroitImageAt(?\DateTimeImmutable $attestationDroitImageAt): static
    {
        $this->attestationDroitImageAt = $attestationDroitImageAt;

        return $this;
    }

    public function getRqUser(): ?string
    {
        return $this->rqUser;
    }

    public function setRqUser(?string $rqUser): static
    {
        $this->rqUser = $rqUser;

        return $this;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveau $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getReglementAt(): ?\DateTimeImmutable
    {
        return $this->reglementAt;
    }

    public function setReglementAt(?\DateTimeImmutable $reglementAt): static
    {
        $this->reglementAt = $reglementAt;

        return $this;
    }

    public function getEntretienAt(): ?\DateTimeImmutable
    {
        return $this->entretienAt;
    }

    public function setEntretienAt(?\DateTimeImmutable $entretienAt): static
    {
        $this->entretienAt = $entretienAt;

        return $this;
    }

    public function getTestAt(): ?\DateTimeImmutable
    {
        return $this->testAt;
    }

    public function setTestAt(?\DateTimeImmutable $testAt): static
    {
        $this->testAt = $testAt;

        return $this;
    }

    public function getResultatTest(): ?float
    {
        return $this->resultatTest;
    }

    public function setResultatTest(?float $resultatTest): static
    {
        $this->resultatTest = $resultatTest;

        return $this;
    }

    public function getDossier(): ?Document
    {
        return $this->dossier;
    }

    public function setDossier(?Document $dossier): static
    {
        $this->dossier = $dossier;

        return $this;
    }

    public function getCv(): ?Document
    {
        return $this->cv;
    }

    public function setCv(?Document $cv): static
    {
        $this->cv = $cv;

        return $this;
    }

    public function getDecision(): ?string
    {
        return $this->decision;
    }

    public function setDecision(?string $decision): static
    {
        $this->decision = $decision;

        return $this;
    }

    public function getDecisionAt(): ?\DateTimeImmutable
    {
        return $this->decisionAt;
    }

    public function setDecisionAt(?\DateTimeImmutable $decisionAt): static
    {
        $this->decisionAt = $decisionAt;

        return $this;
    }

    public function getRythme(): ?Rythme
    {
        return $this->rythme;
    }

    public function setRythme(?Rythme $rythme): static
    {
        $this->rythme = $rythme;

        return $this;
    }

    /**
     * @return Collection<int, Log>
     */
    public function getLogs(): Collection
    {
        return $this->logs;
    }

    public function addLog(Log $log): static
    {
        if (!$this->logs->contains($log)) {
            $this->logs->add($log);
            $log->setUser($this);
        }

        return $this;
    }

    public function removeLog(Log $log): static
    {
        if ($this->logs->removeElement($log)) {
            // set the owning side to null (unless already changed)
            if ($log->getUser() === $this) {
                $log->setUser(null);
            }
        }

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
            $liaison->setProf($this);
        }

        return $this;
    }

    public function removeLiaison(Liaison $liaison): static
    {
        if ($this->liaisons->removeElement($liaison)) {
            // set the owning side to null (unless already changed)
            if ($liaison->getProf() === $this) {
                $liaison->setProf(null);
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
            $devoirRendu->setEleve($this);
        }

        return $this;
    }

    public function removeDevoirRendu(DevoirRendu $devoirRendu): static
    {
        if ($this->devoirRendus->removeElement($devoirRendu)) {
            // set the owning side to null (unless already changed)
            if ($devoirRendu->getEleve() === $this) {
                $devoirRendu->setEleve(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DevoirQcmRendu>
     */
    public function getDevoirQcmRendus(): Collection
    {
        return $this->devoirQcmRendus;
    }

    public function addDevoirQcmRendu(DevoirQcmRendu $devoirQcmRendu): static
    {
        if (!$this->devoirQcmRendus->contains($devoirQcmRendu)) {
            $this->devoirQcmRendus->add($devoirQcmRendu);
            $devoirQcmRendu->setUser($this);
        }

        return $this;
    }

    public function removeDevoirQcmRendu(DevoirQcmRendu $devoirQcmRendu): static
    {
        if ($this->devoirQcmRendus->removeElement($devoirQcmRendu)) {
            // set the owning side to null (unless already changed)
            if ($devoirQcmRendu->getUser() === $this) {
                $devoirQcmRendu->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CoursDistance>
     */
    public function getCoursDistances(): Collection
    {
        return $this->coursDistances;
    }

    public function addCoursDistance(CoursDistance $coursDistance): static
    {
        if (!$this->coursDistances->contains($coursDistance)) {
            $this->coursDistances->add($coursDistance);
            $coursDistance->setUser($this);
        }

        return $this;
    }

    public function removeCoursDistance(CoursDistance $coursDistance): static
    {
        if ($this->coursDistances->removeElement($coursDistance)) {
            // set the owning side to null (unless already changed)
            if ($coursDistance->getUser() === $this) {
                $coursDistance->setUser(null);
            }
        }

        return $this;
    }

    public function isIsVerified(): ?bool
    {
        return $this->isVerified;
    }





}
