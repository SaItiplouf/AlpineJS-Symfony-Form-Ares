<?php

namespace App\Entity;

use App\Repository\GroupeFonctionnaliteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupeFonctionnaliteRepository::class)]
class GroupeFonctionnalite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $remarque = null;

    #[ORM\ManyToMany(targetEntity: GroupeDroit::class, inversedBy: 'groupeFonctionnalites')]
    private Collection $groupeDroits;

    #[ORM\ManyToOne(inversedBy: 'groupeFonctionnalites')]
    private ?GroupeFonctionnaliteCategory $groupeFonctionnaliteCategory = null;

    public function __construct()
    {
        $this->groupeDroits = new ArrayCollection();
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
     * @return Collection<int, GroupeDroit>
     */
    public function getGroupeDroits(): Collection
    {
        return $this->groupeDroits;
    }

    public function addGroupeDroit(GroupeDroit $groupeDroit): static
    {
        if (!$this->groupeDroits->contains($groupeDroit)) {
            $this->groupeDroits->add($groupeDroit);
        }

        return $this;
    }

    public function removeGroupeDroit(GroupeDroit $groupeDroit): static
    {
        $this->groupeDroits->removeElement($groupeDroit);

        return $this;
    }

    public function getGroupeFonctionnaliteCategory(): ?GroupeFonctionnaliteCategory
    {
        return $this->groupeFonctionnaliteCategory;
    }

    public function setGroupeFonctionnaliteCategory(?GroupeFonctionnaliteCategory $groupeFonctionnaliteCategory): static
    {
        $this->groupeFonctionnaliteCategory = $groupeFonctionnaliteCategory;

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom;
    }
}
