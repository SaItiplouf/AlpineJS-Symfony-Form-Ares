<?php

namespace App\Entity;

use App\Repository\LiaisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LiaisonRepository::class)]
class Liaison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $code = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeImmutable $dateDat = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeImmutable $dateFat = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'liaisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $prof = null;

    #[ORM\ManyToOne(inversedBy: 'liaisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SessionFormation $promotion = null;

    #[ORM\ManyToMany(targetEntity: BlocCompetence::class, inversedBy: 'liaisons')]
    private Collection $blocs;

    #[ORM\Column(nullable: true)]
    private ?float $nbHeures = null;

    #[ORM\Column(nullable: true)]
    private ?float $tarif = null;

    #[ORM\ManyToOne(inversedBy: 'liaisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $createur = null;

    public function __construct()
    {
        $this->blocs = new ArrayCollection();
    }
    public function __toString(): string
    {
        return $this->getPromotion();
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

    public function getDateDat(): ?\DateTimeImmutable
    {
        return $this->dateDat;
    }

    public function setDateDat(\DateTimeImmutable $dateDat): static
    {
        $this->dateDat = $dateDat;

        return $this;
    }

    public function getDateFat(): ?\DateTimeImmutable
    {
        return $this->dateFat;
    }

    public function setDateFat(\DateTimeImmutable $dateFat): static
    {
        $this->dateFat = $dateFat;

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

    public function getProf(): ?User
    {
        return $this->prof;
    }

    public function setProf(?User $prof): static
    {
        $this->prof = $prof;

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

    /**
     * @return Collection<int, BlocCompetence>
     */
    public function getBlocs(): Collection
    {
        return $this->blocs;
    }

    public function addBloc(BlocCompetence $bloc): static
    {
        if (!$this->blocs->contains($bloc)) {
            $this->blocs->add($bloc);
        }

        return $this;
    }

    public function removeBloc(BlocCompetence $bloc): static
    {
        $this->blocs->removeElement($bloc);

        return $this;
    }

    public function getNbHeures(): ?float
    {
        return $this->nbHeures;
    }

    public function setNbHeures(?float $nbHeures): static
    {
        $this->nbHeures = $nbHeures;

        return $this;
    }

    public function getTarif(): ?float
    {
        return $this->tarif;
    }

    public function setTarif(?float $tarif): static
    {
        $this->tarif = $tarif;

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
}
