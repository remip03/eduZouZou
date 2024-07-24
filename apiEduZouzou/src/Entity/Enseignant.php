<?php

namespace App\Entity;

use App\Repository\EnseignantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnseignantRepository::class)]
class Enseignant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $lastNameT = null;

    #[ORM\Column(length: 50)]
    private ?string $firstNameT = null;

    #[ORM\Column(length: 50)]
    private ?string $mailT = null;

    #[ORM\Column(length: 60)]
    private ?string $passT = null;

    #[ORM\Column(length: 20)]
    private ?string $telephoneT = null;

    #[ORM\Column(length: 50)]
    private ?string $adresseT = null;

    #[ORM\ManyToOne(inversedBy: 'enseignants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Classe $classe = null;

    /**
     * @var Collection<int, Ressource>
     */
    #[ORM\ManyToMany(targetEntity: Ressource::class, inversedBy: 'enseignants')]
    private Collection $ressources;

    #[ORM\ManyToOne(inversedBy: 'enseignants')]
    private ?Ecole $ecole = null;

    public function __construct()
    {
        $this->ressources = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastNameT(): ?string
    {
        return $this->lastNameT;
    }

    public function setLastNameT(string $lastNameT): static
    {
        $this->lastNameT = $lastNameT;

        return $this;
    }

    public function getFirstNameT(): ?string
    {
        return $this->firstNameT;
    }

    public function setFirstNameT(string $firstNameT): static
    {
        $this->firstNameT = $firstNameT;

        return $this;
    }

    public function getMailT(): ?string
    {
        return $this->mailT;
    }

    public function setMailT(string $mailT): static
    {
        $this->mailT = $mailT;

        return $this;
    }

    public function getPassT(): ?string
    {
        return $this->passT;
    }

    public function setPassT(string $passT): static
    {
        $this->passT = $passT;

        return $this;
    }

    public function getTelephoneT(): ?string
    {
        return $this->telephoneT;
    }

    public function setTelephoneT(string $telephoneT): static
    {
        $this->telephoneT = $telephoneT;

        return $this;
    }

    public function getAdresseT(): ?string
    {
        return $this->adresseT;
    }

    public function setAdresseT(string $adresseT): static
    {
        $this->adresseT = $adresseT;

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

    public function getEcole(): ?Ecole
    {
        return $this->ecole;
    }

    public function setEcole(?Ecole $ecole): static
    {
        $this->ecole = $ecole;

        return $this;
    }
}
