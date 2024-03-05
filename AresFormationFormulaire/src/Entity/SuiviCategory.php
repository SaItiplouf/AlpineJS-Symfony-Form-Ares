<?php

namespace App\Entity;

use App\Repository\SuiviCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SuiviCategoryRepository::class)]
class SuiviCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: SuiviUser::class)]
    private Collection $suiviUsers;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code = null;

    public function __construct()
    {
        $this->suiviUsers = new ArrayCollection();
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
     * @return Collection<int, SuiviUser>
     */
    public function getSuiviUsers(): Collection
    {
        return $this->suiviUsers;
    }

    public function addSuiviUser(SuiviUser $suiviUser): static
    {
        if (!$this->suiviUsers->contains($suiviUser)) {
            $this->suiviUsers->add($suiviUser);
            $suiviUser->setCategory($this);
        }

        return $this;
    }

    public function removeSuiviUser(SuiviUser $suiviUser): static
    {
        if ($this->suiviUsers->removeElement($suiviUser)) {
            // set the owning side to null (unless already changed)
            if ($suiviUser->getCategory() === $this) {
                $suiviUser->setCategory(null);
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
    public function __toString(): string
    {
        return $this->getNom();
    }
}
