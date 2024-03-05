<?php

namespace App\Entity;

use App\Repository\DevoirQcmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DevoirQcmRepository::class)]
class DevoirQcm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'devoirQcms')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Devoir $devoir = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $question = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $repA = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $repB = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $repC = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $repD = null;

    #[ORM\Column(length: 255)]
    private ?string $vrai = null;

    #[ORM\Column]
    private ?float $point = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $reponse = null;

    #[ORM\OneToMany(mappedBy: 'questionQcm', targetEntity: DevoirQcmRendu::class)]
    private Collection $devoirQcmRendus;

    public function __construct()
    {
        $this->devoirQcmRendus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDevoir(): ?Devoir
    {
        return $this->devoir;
    }

    public function setDevoir(?Devoir $devoir): static
    {
        $this->devoir = $devoir;

        return $this;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getRepA(): ?string
    {
        return $this->repA;
    }

    public function setRepA(string $repA): static
    {
        $this->repA = $repA;

        return $this;
    }

    public function getRepB(): ?string
    {
        return $this->repB;
    }

    public function setRepB(string $repB): static
    {
        $this->repB = $repB;

        return $this;
    }

    public function getRepC(): ?string
    {
        return $this->repC;
    }

    public function setRepC(?string $repC): static
    {
        $this->repC = $repC;

        return $this;
    }

    public function getRepD(): ?string
    {
        return $this->repD;
    }

    public function setRepD(?string $repD): static
    {
        $this->repD = $repD;

        return $this;
    }

    public function getVrai(): ?string
    {
        return $this->vrai;
    }

    public function setVrai(string $vrai): static
    {
        $this->vrai = $vrai;

        return $this;
    }

    public function getPoint(): ?float
    {
        return $this->point;
    }

    public function setPoint(float $point): static
    {
        $this->point = $point;

        return $this;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(?string $reponse): static
    {
        $this->reponse = $reponse;

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
            $devoirQcmRendu->setQuestionQcm($this);
        }

        return $this;
    }

    public function removeDevoirQcmRendu(DevoirQcmRendu $devoirQcmRendu): static
    {
        if ($this->devoirQcmRendus->removeElement($devoirQcmRendu)) {
            // set the owning side to null (unless already changed)
            if ($devoirQcmRendu->getQuestionQcm() === $this) {
                $devoirQcmRendu->setQuestionQcm(null);
            }
        }

        return $this;
    }
}
