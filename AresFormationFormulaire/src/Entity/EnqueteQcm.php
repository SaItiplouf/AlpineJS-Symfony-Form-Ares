<?php

namespace App\Entity;

use App\Repository\EnqueteQcmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnqueteQcmRepository::class)]
class EnqueteQcm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'enqueteQcms')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Enquete $enquete = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $question = null;

    #[ORM\Column(length: 255)]
    private ?string $repA = null;

    #[ORM\Column(length: 255)]
    private ?string $repB = null;

    #[ORM\Column(length: 255)]
    private ?string $repC = null;

    #[ORM\Column(length: 255)]
    private ?string $repD = null;

    #[ORM\Column]
    private ?int $vrai = null;

    #[ORM\Column]
    private ?int $point = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: EnqueteReponse::class)]
    private Collection $enqueteReponses;

    public function __construct()
    {
        $this->enqueteReponses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnquete(): ?Enquete
    {
        return $this->enquete;
    }

    public function setEnquete(?Enquete $enquete): static
    {
        $this->enquete = $enquete;

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

    public function setRepC(string $repC): static
    {
        $this->repC = $repC;

        return $this;
    }

    public function getRepD(): ?string
    {
        return $this->repD;
    }

    public function setRepD(string $repD): static
    {
        $this->repD = $repD;

        return $this;
    }

    public function getVrai(): ?int
    {
        return $this->vrai;
    }

    public function setVrai(int $vrai): static
    {
        $this->vrai = $vrai;

        return $this;
    }

    public function getPoint(): ?int
    {
        return $this->point;
    }

    public function setPoint(int $point): static
    {
        $this->point = $point;

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
            $enqueteReponse->setQuestion($this);
        }

        return $this;
    }

    public function removeEnqueteReponse(EnqueteReponse $enqueteReponse): static
    {
        if ($this->enqueteReponses->removeElement($enqueteReponse)) {
            // set the owning side to null (unless already changed)
            if ($enqueteReponse->getQuestion() === $this) {
                $enqueteReponse->setQuestion(null);
            }
        }

        return $this;
    }
}
