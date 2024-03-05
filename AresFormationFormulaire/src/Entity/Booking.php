<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $start = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $end = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $all_day = null;

    #[ORM\Column(length: 7, nullable: true)]
    private ?string $textcolor = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $prof = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SessionFormation $promotion = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Matiere $matiere = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Salle $salle = null;

    #[ORM\OneToMany(mappedBy: 'booking', targetEntity: Absence::class)]
    private Collection $absences;

    #[ORM\OneToOne(mappedBy: 'booking', cascade: ['persist', 'remove'])]
    private ?SuiviSession $suiviSession = null;

    public function __construct()
    {
        $this->absences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): static
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): static
    {
        $this->end = $end;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isAllDay(): ?bool
    {
        return $this->all_day;
    }

    public function setAllDay(bool $all_day): static
    {
        $this->all_day = $all_day;

        return $this;
    }

    public function getTextcolor(): ?string
    {
        return $this->textcolor;
    }

    public function setTextcolor(?string $textcolor): static
    {
        $this->textcolor = $textcolor;

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

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): static
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(?Salle $salle): static
    {
        $this->salle = $salle;

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
            $absence->setBooking($this);
        }

        return $this;
    }

    public function removeAbsence(Absence $absence): static
    {
        if ($this->absences->removeElement($absence)) {
            // set the owning side to null (unless already changed)
            if ($absence->getBooking() === $this) {
                $absence->setBooking(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        $startDateString = $this->getStart() ? $this->getStart()->format('d-m-Y H:i') : 'Pas de date de début';
        return $this->getTitle().' '.$startDateString.' - '.$this->getProf()->getNom().' - '.$this->getMatiere()->getNom();
    }

    public function getSuiviSession(): ?SuiviSession
    {
        return $this->suiviSession;
    }

    public function setSuiviSession(?SuiviSession $suiviSession): static
    {
        // unset the owning side of the relation if necessary
        if ($suiviSession === null && $this->suiviSession !== null) {
            $this->suiviSession->setBooking(null);
        }

        // set the owning side of the relation if necessary
        if ($suiviSession !== null && $suiviSession->getBooking() !== $this) {
            $suiviSession->setBooking($this);
        }

        $this->suiviSession = $suiviSession;

        return $this;
    }

}
