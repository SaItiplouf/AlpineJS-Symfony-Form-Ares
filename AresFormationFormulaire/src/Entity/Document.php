<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentRepository::class)]
class Document
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updateDate = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $extension = null;

    #[ORM\Column(type: Types::BLOB)]
    private $content = null;

    #[ORM\ManyToOne(inversedBy: 'documents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?DocumentCategory $documentCategory = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $archiveDate = null;

    #[ORM\OneToOne(mappedBy: 'referentiel', cascade: ['persist', 'remove'])]
    private ?Formation $formation = null;

    #[ORM\OneToMany(mappedBy: 'document', targetEntity: Absence::class)]
    private Collection $absences;

    #[ORM\ManyToMany(targetEntity: CoursSeq::class, mappedBy: 'documents')]
    private Collection $coursSeqs;

    #[ORM\OneToMany(mappedBy: 'document', targetEntity: ValidDoc::class)]
    private Collection $validDocs;

    #[ORM\ManyToMany(targetEntity: SuiviSession::class, mappedBy: 'documents')]
    private Collection $suiviSessions;

    #[ORM\OneToMany(mappedBy: 'dossier', targetEntity: User::class)]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'cv', targetEntity: User::class)]
    private Collection $usersCv;

    #[ORM\ManyToMany(targetEntity: Devoir::class, mappedBy: 'enonce')]
    private Collection $devoirs;

    #[ORM\ManyToMany(targetEntity: DevoirRendu::class, mappedBy: 'fichierRendus')]
    private Collection $devoirRendus;



    public function __construct()
    {
        $this->createDate = new \DateTime();
        $this->absences = new ArrayCollection();
        $this->coursSeqs = new ArrayCollection();
        $this->validDocs = new ArrayCollection();
        $this->suiviSessions = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->usersCv = new ArrayCollection();
        $this->devoirs = new ArrayCollection();
        $this->devoirRendus = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->createDate;
    }

    public function setCreateDate(\DateTimeInterface $createDate): static
    {
        $this->createDate = $createDate;

        return $this;
    }

    public function getUpdateDate(): ?\DateTimeInterface
    {
        return $this->updateDate;
    }

    public function setUpdateDate(?\DateTimeInterface $updateDate): static
    {
        $this->updateDate = $updateDate;

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

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): static
    {
        $this->extension = $extension;

        return $this;
    }

    public function getContent()
    {
        //return $this->content;
        if (is_resource($this->content)) {
            return $this->content;
        }

        // Sinon, si le contenu est stocké comme chaîne binaire, vous pouvez le convertir en flux
        $stream = fopen('php://memory','r+');
        fwrite($stream, $this->content);
        rewind($stream);
        return $stream;
    }

    public function setContent($content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getDocumentCategory(): ?DocumentCategory
    {
        return $this->documentCategory;
    }

    public function setDocumentCategory(?DocumentCategory $documentCategory): static
    {
        $this->documentCategory = $documentCategory;

        return $this;
    }

    public function getArchiveDate(): ?\DateTimeInterface
    {
        return $this->archiveDate;
    }

    public function setArchiveDate(?\DateTimeInterface $archiveDate): static
    {
        $this->archiveDate = $archiveDate;

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom.$this->extension;
    }

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $formation): static
    {
        // unset the owning side of the relation if necessary
        if ($formation === null && $this->formation !== null) {
            $this->formation->setReferentiel(null);
        }

        // set the owning side of the relation if necessary
        if ($formation !== null && $formation->getReferentiel() !== $this) {
            $formation->setReferentiel($this);
        }

        $this->formation = $formation;

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
            $absence->setDocument($this);
        }

        return $this;
    }

    public function removeAbsence(Absence $absence): static
    {
        if ($this->absences->removeElement($absence)) {
            // set the owning side to null (unless already changed)
            if ($absence->getDocument() === $this) {
                $absence->setDocument(null);
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
            $coursSeq->addDocument($this);
        }

        return $this;
    }

    public function removeCoursSeq(CoursSeq $coursSeq): static
    {
        if ($this->coursSeqs->removeElement($coursSeq)) {
            $coursSeq->removeDocument($this);
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
            $validDoc->setDocument($this);
        }

        return $this;
    }

    public function removeValidDoc(ValidDoc $validDoc): static
    {
        if ($this->validDocs->removeElement($validDoc)) {
            // set the owning side to null (unless already changed)
            if ($validDoc->getDocument() === $this) {
                $validDoc->setDocument(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SuiviSession>
     */
    public function getSuiviSessions(): Collection
    {
        return $this->suiviSessions;
    }

    public function addSuiviSession(SuiviSession $suiviSession): static
    {
        if (!$this->suiviSessions->contains($suiviSession)) {
            $this->suiviSessions->add($suiviSession);
            $suiviSession->addDocument($this);
        }

        return $this;
    }

    public function removeSuiviSession(SuiviSession $suiviSession): static
    {
        if ($this->suiviSessions->removeElement($suiviSession)) {
            $suiviSession->removeDocument($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setDossier($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getDossier() === $this) {
                $user->setDossier(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsersCv(): Collection
    {
        return $this->usersCv;
    }

    public function addUsersCv(User $usersCv): static
    {
        if (!$this->usersCv->contains($usersCv)) {
            $this->usersCv->add($usersCv);
            $usersCv->setCv($this);
        }

        return $this;
    }

    public function removeUsersCv(User $usersCv): static
    {
        if ($this->usersCv->removeElement($usersCv)) {
            // set the owning side to null (unless already changed)
            if ($usersCv->getCv() === $this) {
                $usersCv->setCv(null);
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
            $devoir->addEnonce($this);
        }

        return $this;
    }

    public function removeDevoir(Devoir $devoir): static
    {
        if ($this->devoirs->removeElement($devoir)) {
            $devoir->removeEnonce($this);
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
            $devoirRendu->addFichierRendu($this);
        }

        return $this;
    }

    public function removeDevoirRendu(DevoirRendu $devoirRendu): static
    {
        if ($this->devoirRendus->removeElement($devoirRendu)) {
            $devoirRendu->removeFichierRendu($this);
        }

        return $this;
    }


}
