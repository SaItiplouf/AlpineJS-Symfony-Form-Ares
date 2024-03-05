<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $objectif = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $debouche = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $duree = null;

    #[ORM\Column]
    private ?bool $hasStage = null;

    #[ORM\Column]
    private ?float $prixFormation = null;

    #[ORM\Column(nullable: true)]
    private ?float $prixAnnexe = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $codeRNCP = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lienRNCP = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\ManyToOne(inversedBy: 'formations')]
    private ?Niveau $niveauEntree = null;

    #[ORM\ManyToOne(inversedBy: 'formationSorties')]
    private ?Niveau $niveauSortie = null;

    #[ORM\ManyToOne(inversedBy: 'formations')]
    private ?TypeFormation $typeFormation = null;

    #[ORM\ManyToOne(inversedBy: 'formations')]
    private ?Domaine $domaine = null;

    #[ORM\ManyToOne(inversedBy: 'formations')]
    private ?Rythme $rythme = null;

    #[ORM\ManyToMany(targetEntity: BlocCompetence::class, inversedBy: 'formations')]
    private Collection $blocCompetences;

    #[ORM\OneToMany(mappedBy: 'formation', targetEntity: SessionFormation::class)]
    private Collection $sessionFormations;

    #[ORM\OneToOne(inversedBy: 'formation', cascade: ['persist', 'remove'])]
    private ?Document $referentiel = null;

    #[ORM\ManyToMany(targetEntity: Cours::class, mappedBy: 'formations')]
    private Collection $cours;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code = null;

    #[ORM\OneToMany(mappedBy: 'formation', targetEntity: IntituleTechnique::class)]
    private Collection $intituleTechniques;



    public function __construct()
    {
        $this->blocCompetences = new ArrayCollection();
        $this->sessionFormations = new ArrayCollection();
        $this->cours = new ArrayCollection();
        $this->intituleTechniques = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getObjectif(): ?string
    {
        return $this->objectif;
    }

    public function setObjectif(string $objectif): static
    {
        $this->objectif = $objectif;

        return $this;
    }

    public function getDebouche(): ?string
    {
        return $this->debouche;
    }

    public function setDebouche(string $debouche): static
    {
        $this->debouche = $debouche;

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

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function isHasStage(): ?bool
    {
        return $this->hasStage;
    }

    public function setHasStage(bool $hasStage): static
    {
        $this->hasStage = $hasStage;

        return $this;
    }

    public function getPrixFormation(): ?float
    {
        return $this->prixFormation;
    }

    public function setPrixFormation(float $prixFormation): static
    {
        $this->prixFormation = $prixFormation;

        return $this;
    }

    public function getPrixAnnexe(): ?float
    {
        return $this->prixAnnexe;
    }

    public function setPrixAnnexe(?float $prixAnnexe): static
    {
        $this->prixAnnexe = $prixAnnexe;

        return $this;
    }

    public function getCodeRNCP(): ?string
    {
        return $this->codeRNCP;
    }

    public function setCodeRNCP(?string $codeRNCP): static
    {
        $this->codeRNCP = $codeRNCP;

        return $this;
    }

    public function getLienRNCP(): ?string
    {
        return $this->lienRNCP;
    }

    public function setLienRNCP(?string $lienRNCP): static
    {
        $this->lienRNCP = $lienRNCP;

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

    public function getNiveauEntree(): ?Niveau
    {
        return $this->niveauEntree;
    }

    public function setNiveauEntree(?Niveau $niveauEntree): static
    {
        $this->niveauEntree = $niveauEntree;

        return $this;
    }

    public function getNiveauSortie(): ?Niveau
    {
        return $this->niveauSortie;
    }

    public function setNiveauSortie(?Niveau $niveauSortie): static
    {
        $this->niveauSortie = $niveauSortie;

        return $this;
    }

    public function getTypeFormation(): ?TypeFormation
    {
        return $this->typeFormation;
    }

    public function setTypeFormation(?TypeFormation $typeFormation): static
    {
        $this->typeFormation = $typeFormation;

        return $this;
    }

    public function getDomaine(): ?Domaine
    {
        return $this->domaine;
    }

    public function setDomaine(?Domaine $domaine): static
    {
        $this->domaine = $domaine;

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
            $sessionFormation->setFormation($this);
        }

        return $this;
    }

    public function removeSessionFormation(SessionFormation $sessionFormation): static
    {
        if ($this->sessionFormations->removeElement($sessionFormation)) {
            // set the owning side to null (unless already changed)
            if ($sessionFormation->getFormation() === $this) {
                $sessionFormation->setFormation(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getNom();
    }

    public function getReferentiel(): ?Document
    {
        return $this->referentiel;
    }

    public function setReferentiel(?Document $referentiel): static
    {
        $this->referentiel = $referentiel;

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
            $cour->addFormation($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): static
    {
        if ($this->cours->removeElement($cour)) {
            $cour->removeFormation($this);
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
            $intituleTechnique->setFormation($this);
        }

        return $this;
    }

    public function removeIntituleTechnique(IntituleTechnique $intituleTechnique): static
    {
        if ($this->intituleTechniques->removeElement($intituleTechnique)) {
            // set the owning side to null (unless already changed)
            if ($intituleTechnique->getFormation() === $this) {
                $intituleTechnique->setFormation(null);
            }
        }

        return $this;
    }

  
}
