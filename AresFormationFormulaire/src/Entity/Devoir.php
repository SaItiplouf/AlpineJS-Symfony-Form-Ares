<?php

namespace App\Entity;

use App\Repository\DevoirRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DevoirRepository::class)]
class Devoir
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'devoirs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $createur = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255)]
    private ?\DateTimeImmutable $dateDevoir = null;

    #[ORM\Column]
    private ?int $coefficient = null;

    #[ORM\ManyToOne(inversedBy: 'devoirs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SessionFormation $promotion = null;

    #[ORM\ManyToOne(inversedBy: 'devoirs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Matiere $matiere = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $dateD = null;


    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $dateF = null;

    #[ORM\ManyToOne(inversedBy: 'devoirs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?DevoirT $type = null;


    #[ORM\OneToMany(mappedBy: 'devoir', targetEntity: DevoirQcm::class)]
    private Collection $devoirQcms;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\OneToMany(mappedBy: 'devoir', targetEntity: DevoirNote::class)]
    private Collection $devoirNotes;

    #[ORM\ManyToMany(targetEntity: BlocCompetence::class)]
    private Collection $blocCompetences;

    #[ORM\ManyToOne(inversedBy: 'devoirs')]
    private ?IntituleTechnique $intituleTechnique = null;

    #[ORM\ManyToMany(targetEntity: Document::class, inversedBy: 'devoirs')]
    private Collection $enonce;

    #[ORM\OneToMany(mappedBy: 'devoir', targetEntity: DevoirRendu::class, orphanRemoval: true)]
    private Collection $devoirRendus;

    #[ORM\OneToMany(mappedBy: 'devoirQcm', targetEntity: DevoirQcmRendu::class)]
    private Collection $devoirQcmRendus;

    

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

    public function getCreateur(): ?User
    {
        return $this->createur;
    }

    public function setCreateur(?User $createur): static
    {
        $this->createur = $createur;

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

    public function getDateDevoir(): ?\DateTimeImmutable
    {
        return $this->dateDevoir;
    }

    public function setDateDevoir(\DateTimeImmutable $dateDevoir): self
    {
        $this->dateDevoir = $dateDevoir;

        return $this;
    }

    public function getCoefficient(): ?int
    {
        return $this->coefficient;
    }

    public function setCoefficient(int $coefficient): static
    {
        $this->coefficient = $coefficient;

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

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): static
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getDateD(): ?\DateTimeInterface
    {
        return $this->dateD;
    }

    public function setDateD(\DateTimeInterface $dateD): static
    {
        $this->dateD = $dateD;

        return $this;
    }

    public function getDateF(): ?\DateTimeInterface
    {
        return $this->dateF;
    }

    public function setDateF(?\DateTimeInterface $dateF): static
    {
        $this->dateF = $dateF;

        return $this;
    }

    public function getType(): ?DevoirT
    {
        return $this->type;
    }

    public function setType(?DevoirT $type): static
    {
        $this->type = $type;

        return $this;
    }
    public function __construct()
    {
        $this->setCreatedAt(new \DateTimeImmutable());
        $this->devoirQcms = new ArrayCollection();
        $this->devoirNotes = new ArrayCollection();
        $this->blocCompetences = new ArrayCollection();

        // Définir la date de fin à aujourd'hui par défaut
        $this->dateF = new \DateTimeImmutable();
        $this->dateD = new \DateTimeImmutable();
        $this->enonce = new ArrayCollection();
        $this->devoirRendus = new ArrayCollection();
        $this->devoirQcmRendus = new ArrayCollection();

    }

    /*public function getCompetences(): ?array
    {
        return $this->competences;
    }


    public function setCompetences(?array $competences): static
    {
        $this->competences = $competences;

        return $this;
    }
    */

    /**
     * @return Collection<int, DevoirQcm>
     */
    public function getDevoirQcms(): Collection
    {
        return $this->devoirQcms;
    }

    public function addDevoirQcm(DevoirQcm $devoirQcm): static
    {
        if (!$this->devoirQcms->contains($devoirQcm)) {
            $this->devoirQcms->add($devoirQcm);
            $devoirQcm->setDevoir($this);
        }

        return $this;
    }

    public function removeDevoirQcm(DevoirQcm $devoirQcm): static
    {
        if ($this->devoirQcms->removeElement($devoirQcm)) {
            // set the owning side to null (unless already changed)
            if ($devoirQcm->getDevoir() === $this) {
                $devoirQcm->setDevoir(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getNom();
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

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
            $devoirNote->setDevoir($this);
        }

        return $this;
    }

    public function removeDevoirNote(DevoirNote $devoirNote): static
    {
        if ($this->devoirNotes->removeElement($devoirNote)) {
            // set the owning side to null (unless already changed)
            if ($devoirNote->getDevoir() === $this) {
                $devoirNote->setDevoir(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BlocCompetence>
     */
    public function getBlocCompetences(): Collection
    {
        return $this->blocCompetences;
    }

    public function addBlocCompetence(BlocCompetence $blocCompetence): static
    {
        if (!$this->blocCompetences->contains($blocCompetence)) {
            $this->blocCompetences->add($blocCompetence);
        }

        return $this;
    }

    public function removeBlocCompetence(BlocCompetence $blocCompetence): static
    {
        $this->blocCompetences->removeElement($blocCompetence);

        return $this;
    }

    public function getIntituleTechnique(): ?IntituleTechnique
    {
        return $this->intituleTechnique;
    }

    public function setIntituleTechnique(?IntituleTechnique $intituleTechnique): static
    {
        $this->intituleTechnique = $intituleTechnique;

        return $this;
    }

    /**
     * @return Collection<int, Document>
     */
    public function getEnonce(): Collection
    {
        return $this->enonce;
    }

    public function addEnonce(Document $enonce): static
    {
        if (!$this->enonce->contains($enonce)) {
            $this->enonce->add($enonce);
        }

        return $this;
    }

    public function removeEnonce(Document $enonce): static
    {
        $this->enonce->removeElement($enonce);

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
            $devoirRendu->setDevoir($this);
        }

        return $this;
    }

    public function removeDevoirRendu(DevoirRendu $devoirRendu): static
    {
        if ($this->devoirRendus->removeElement($devoirRendu)) {
            // set the owning side to null (unless already changed)
            if ($devoirRendu->getDevoir() === $this) {
                $devoirRendu->setDevoir(null);
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
            $devoirQcmRendu->setDevoirQcm($this);
        }

        return $this;
    }

    public function removeDevoirQcmRendu(DevoirQcmRendu $devoirQcmRendu): static
    {
        if ($this->devoirQcmRendus->removeElement($devoirQcmRendu)) {
            // set the owning side to null (unless already changed)
            if ($devoirQcmRendu->getDevoirQcm() === $this) {
                $devoirQcmRendu->setDevoirQcm(null);
            }
        }

        return $this;
    }


}
