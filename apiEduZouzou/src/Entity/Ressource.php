<?php

namespace App\Entity;

use App\Repository\RessourceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RessourceRepository::class)]
class Ressource
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $typeR = null;

    #[ORM\Column(length: 50)]
    private ?string $nameR = null;

    /**
     * @var Collection<int, Enseignant>
     */
    #[ORM\ManyToMany(targetEntity: Enseignant::class, mappedBy: 'ressources')]
    private Collection $enseignants;

    /**
     * @var Collection<int, Enfant>
     */
    #[ORM\ManyToMany(targetEntity: Enfant::class, mappedBy: 'ressources')]
    private Collection $enfants;

    public function __construct()
    {
        $this->enseignants = new ArrayCollection();
        $this->enfants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isTypeR(): ?bool
    {
        return $this->typeR;
    }

    public function setTypeR(bool $typeR): static
    {
        $this->typeR = $typeR;

        return $this;
    }

    public function getNameR(): ?string
    {
        return $this->nameR;
    }

    public function setNameR(string $nameR): static
    {
        $this->nameR = $nameR;

        return $this;
    }

    /**
     * @return Collection<int, Enseignant>
     */
    public function getEnseignants(): Collection
    {
        return $this->enseignants;
    }

    public function addEnseignant(Enseignant $enseignant): static
    {
        if (!$this->enseignants->contains($enseignant)) {
            $this->enseignants->add($enseignant);
            $enseignant->addRessource($this);
        }

        return $this;
    }

    public function removeEnseignant(Enseignant $enseignant): static
    {
        if ($this->enseignants->removeElement($enseignant)) {
            $enseignant->removeRessource($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Enfant>
     */
    public function getEnfants(): Collection
    {
        return $this->enfants;
    }

    public function addEnfant(Enfant $enfant): static
    {
        if (!$this->enfants->contains($enfant)) {
            $this->enfants->add($enfant);
            $enfant->addRessource($this);
        }

        return $this;
    }

    public function removeEnfant(Enfant $enfant): static
    {
        if ($this->enfants->removeElement($enfant)) {
            $enfant->removeRessource($this);
        }

        return $this;
    }
}
