<?php

namespace App\Entity;

use App\Repository\GroupeFonctionnaliteCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupeFonctionnaliteCategoryRepository::class)]
class GroupeFonctionnaliteCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'groupeFonctionnaliteCategory', targetEntity: GroupeFonctionnalite::class)]
    private Collection $groupeFonctionnalites;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code = null;

    public function __construct()
    {
        $this->groupeFonctionnalites = new ArrayCollection();
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
            $groupeFonctionnalite->setGroupeFonctionnaliteCategory($this);
        }

        return $this;
    }

    public function removeGroupeFonctionnalite(GroupeFonctionnalite $groupeFonctionnalite): static
    {
        if ($this->groupeFonctionnalites->removeElement($groupeFonctionnalite)) {
            // set the owning side to null (unless already changed)
            if ($groupeFonctionnalite->getGroupeFonctionnaliteCategory() === $this) {
                $groupeFonctionnalite->setGroupeFonctionnaliteCategory(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom;
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
}
