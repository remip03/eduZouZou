<?php

namespace App\Entity;

use App\Repository\EnfantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnfantRepository::class)]
class Enfant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $lastNameE = null;

    #[ORM\Column(length: 50)]
    private ?string $firstNameE = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $birthDateE = null;

    #[ORM\ManyToOne(inversedBy: 'enfants')]
    private ?Classe $classe = null;

    /**
     * @var Collection<int, Ressource>
     */
    #[ORM\ManyToMany(targetEntity: Ressource::class, inversedBy: 'enfants')]
    private Collection $ressources;

    /**
     * @var Collection<int, Activite>
     */
    #[ORM\ManyToMany(targetEntity: Activite::class, inversedBy: 'enfants')]
    private Collection $activites;

    public function __construct()
    {
        $this->ressources = new ArrayCollection();
        $this->activites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastNameE(): ?string
    {
        return $this->lastNameE;
    }

    public function setLastNameE(string $lastNameE): static
    {
        $this->lastNameE = $lastNameE;

        return $this;
    }

    public function getFirstNameE(): ?string
    {
        return $this->firstNameE;
    }

    public function setFirstNameE(string $firstNameE): static
    {
        $this->firstNameE = $firstNameE;

        return $this;
    }

    public function getBirthDateE(): ?\DateTimeImmutable
    {
        return $this->birthDateE;
    }

    public function setBirthDateE(\DateTimeImmutable $birthDateE): static
    {
        $this->birthDateE = $birthDateE;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): static
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return Collection<int, Ressource>
     */
    public function getRessources(): Collection
    {
        return $this->ressources;
    }

    public function addRessource(Ressource $ressource): static
    {
        if (!$this->ressources->contains($ressource)) {
            $this->ressources->add($ressource);
        }

        return $this;
    }

    public function removeRessource(Ressource $ressource): static
    {
        $this->ressources->removeElement($ressource);

        return $this;
    }

    /**
     * @return Collection<int, Activite>
     */
    public function getActivites(): Collection
    {
        return $this->activites;
    }

    public function addActivite(Activite $activite): static
    {
        if (!$this->activites->contains($activite)) {
            $this->activites->add($activite);
        }

        return $this;
    }

    public function removeActivite(Activite $activite): static
    {
        $this->activites->removeElement($activite);

        return $this;
    }
}
