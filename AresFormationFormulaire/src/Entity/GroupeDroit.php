<?php

namespace App\Entity;

use App\Repository\GroupeDroitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupeDroitRepository::class)]
class GroupeDroit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'droits', cascade: ['persist', 'remove'])]
    private Collection $users;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $remarque = null;

    #[ORM\ManyToMany(targetEntity: GroupeFonctionnalite::class, mappedBy: 'groupeDroits')]
    private Collection $groupeFonctionnalites;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->groupeFonctionnalites = new ArrayCollection();
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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
            $user->addDroit($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeDroit($this);
        }

        return $this;
    }

    public function setUsers(Collection $user): static
    {
        $this->users = $user;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getNom();
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

    /**
     * @return Collection<int, GroupeFonctionnalite>
     */
    public function getGroupeFonctionnalites(): Collection
    {
        return $this->groupeFonctionnalites;
    }

    public function addGroupeFonctionnalite(GroupeFonctionnalite $groupeFonctionnalite): static
    {
        if (!$this->groupeFonctionnalites->contains($groupeFonctionnalite)) {
            $this->groupeFonctionnalites->add($groupeFonctionnalite);
            $groupeFonctionnalite->addGroupeDroit($this);
        }

        return $this;
    }

    public function removeGroupeFonctionnalite(GroupeFonctionnalite $groupeFonctionnalite): static
    {
        if ($this->groupeFonctionnalites->removeElement($groupeFonctionnalite)) {
            $groupeFonctionnalite->removeGroupeDroit($this);
        }

        return $this;
    }
}
