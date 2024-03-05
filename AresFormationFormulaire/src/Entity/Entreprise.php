<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 6)]
    private ?string $cp = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contactCivilite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contactNom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contactMail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contactTel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contactPoste = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $remarque = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'entreprises')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $taille = null;

    #[ORM\Column(length: 10)]
    private ?string $codeNaf = null;

    #[ORM\ManyToOne(inversedBy: 'entreprises')]
    #[ORM\JoinColumn(nullable: false)]
    private ?EntrepriseType $typeEntreprise = null;

    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: EntrepriseDossier::class)]
    private Collection $entrepriseDossiers;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->entrepriseDossiers = new ArrayCollection();

    }

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): static
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getContactCivilite(): ?string
    {
        return $this->contactCivilite;
    }

    public function setContactCivilite(string $contactCivilite): static
    {
        $this->contactCivilite = $contactCivilite;

        return $this;
    }

    public function getContactNom(): ?string
    {
        return $this->contactNom;
    }

    public function setContactNom(string $contactNom): static
    {
        $this->contactNom = $contactNom;

        return $this;
    }

    public function getContactMail(): ?string
    {
        return $this->contactMail;
    }

    public function setContactMail(string $contactMail): static
    {
        $this->contactMail = $contactMail;

        return $this;
    }

    public function getContactTel(): ?string
    {
        return $this->contactTel;
    }
    public function __toString(): string
    {
        return $this->getNom();
    }

    public function setContactTel(string $contactTel): static
    {
        $this->contactTel = $contactTel;

        return $this;
    }

    public function getContactPoste(): ?string
    {
        return $this->contactPoste;
    }

    public function setContactPoste(string $contactPoste): static
    {
        $this->contactPoste = $contactPoste;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(string $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    public function getCodeNaf(): ?string
    {
        return $this->codeNaf;
    }

    public function setCodeNaf(string $codeNaf): static
    {
        $this->codeNaf = $codeNaf;

        return $this;
    }

    public function getTypeEntreprise(): ?EntrepriseType
    {
        return $this->typeEntreprise;
    }

    public function setTypeEntreprise(?EntrepriseType $typeEntreprise): static
    {
        $this->typeEntreprise = $typeEntreprise;

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
            $entrepriseDossier->setEntreprise($this);
        }

        return $this;
    }

    public function removeEntrepriseDossier(EntrepriseDossier $entrepriseDossier): static
    {
        if ($this->entrepriseDossiers->removeElement($entrepriseDossier)) {
            // set the owning side to null (unless already changed)
            if ($entrepriseDossier->getEntreprise() === $this) {
                $entrepriseDossier->setEntreprise(null);
            }
        }

        return $this;
    }
}
