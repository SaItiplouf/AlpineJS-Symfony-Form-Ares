<?php

namespace App\Entity;

use App\Repository\SuiviSessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SuiviSessionRepository::class)]
class SuiviSession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: BlocCompetence::class, inversedBy: 'suiviSessions')]
    private Collection $blocCompetences;

    #[ORM\OneToOne(inversedBy: 'suiviSession', cascade: ['persist', 'remove'])]
    private ?Booking $booking = null;

    #[ORM\ManyToMany(targetEntity: Document::class, inversedBy: 'suiviSessions')]
    private Collection $documents;


    #[ORM\Column(length: 500, nullable: true)]
    private ?string $remarque = null;

    public function __construct()
    {
        $this->blocCompetences = new ArrayCollection();
        $this->documents = new ArrayCollection();

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

    public function __toString(): string
    {
        return $this->getDescription();
    }

    public function getBooking(): ?Booking
    {
        return $this->booking;
    }

    public function setBooking(?Booking $booking): static
    {
        $this->booking = $booking;

        return $this;
    }

    /**
     * @return Collection<int, Document>
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): static
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);
        }

        return $this;
    }

    public function removeDocument(Document $document): static
    {
        $this->documents->removeElement($document);

        return $this;
    }



    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(?string $remarque): static
    {
        $this->remarque = $remarque;

        return $this;
    }
}
