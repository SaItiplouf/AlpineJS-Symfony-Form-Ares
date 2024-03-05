<?php

namespace App\Entity;

use App\Repository\BlocCompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlocCompetenceRepository::class)]
class BlocCompetence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $ordre = null;

    #[ORM\ManyToMany(targetEntity: Formation::class, mappedBy: 'blocCompetences')]
    private Collection $formations;

    #[ORM\ManyToMany(targetEntity: SuiviSession::class, mappedBy: 'blocCompetences')]
    private Collection $suiviSessions;

    #[ORM\OneToMany(mappedBy: 'competence', targetEntity: BlocCompetenceValide::class)]
    private Collection $blocCompetenceValides;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'children')]
    private ?self $parent = null;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class, orphanRemoval: true)]
    private Collection $children;

    #[ORM\ManyToMany(targetEntity: Liaison::class, mappedBy: 'blocs')]
    private Collection $liaisons;

    #[ORM\ManyToMany(targetEntity: Cours::class, mappedBy: 'competences')]
    private Collection $cours;

    public function __construct()
    {
        $this->formations = new ArrayCollection();
        $this->suiviSessions = new ArrayCollection();
        $this->blocCompetenceValides = new ArrayCollection();
        $this->children = new ArrayCollection();
        $this->liaisons = new ArrayCollection();
        $this->cours = new ArrayCollection();
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

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): static
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * @return Collection<int, Formation>
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): static
    {
        if (!$this->formations->contains($formation)) {
            $this->formations->add($formation);
            $formation->addBlocCompetence($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): static
    {
        if ($this->formations->removeElement($formation)) {
            $formation->removeBlocCompetence($this);
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
            $suiviSession->addBlocCompetence($this);
        }

        return $this;
    }

    public function removeSuiviSession(SuiviSession $suiviSession): static
    {
        if ($this->suiviSessions->removeElement($suiviSession)) {
            $suiviSession->removeBlocCompetence($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        $ordre = '';
        $description = '';
        $fullOrder = $this->createFullOrder($this, $ordre);
        $fullDesc = $this->createFullDescription($this, $description);
        return $fullOrder . $fullDesc;
    }


    private function createFullOrder(BlocCompetence $bloc, $ordre) {
        while (!empty($bloc)) {
            $ordre = strval($bloc->getOrdre()) . ' - ' . $ordre;
            $bloc = $bloc->getParent();
            if (!empty($bloc)) {
                $this->createFullOrder($bloc, $ordre);
            }
        }

        return $ordre;
    }

    private function createFullDescription(BlocCompetence $bloc, $description) {
        while (!empty($bloc)) {
            $description = $bloc->getDescription() . ' - ' . $description;
            $bloc = $bloc->getParent();
            if (!empty($bloc)) {
                $this->createFullOrder($bloc, $description);
            }
        }

        return $description;
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
            $blocCompetenceValide->setCompetence($this);
        }

        return $this;
    }

    public function removeBlocCompetenceValide(BlocCompetenceValide $blocCompetenceValide): static
    {
        if ($this->blocCompetenceValides->removeElement($blocCompetenceValide)) {
            // set the owning side to null (unless already changed)
            if ($blocCompetenceValide->getCompetence() === $this) {
                $blocCompetenceValide->setCompetence(null);
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

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(self $child): static
    {
        if (!$this->children->contains($child)) {
            $this->children->add($child);
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(self $child): static
    {
        if ($this->children->removeElement($child)) {
            // set the owning side to null (unless already changed)
            if ($child->getParent() === $this) {
                $child->setParent(null);
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
            $liaison->addBloc($this);
        }

        return $this;
    }

    public function removeLiaison(Liaison $liaison): static
    {
        if ($this->liaisons->removeElement($liaison)) {
            $liaison->removeBloc($this);
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
            $cour->addCompetence($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): static
    {
        if ($this->cours->removeElement($cour)) {
            $cour->removeCompetence($this);
        }

        return $this;
    }
}
