<?php

namespace App\Entity;

use App\Repository\RessourceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;

#[ORM\Entity(repositoryClass: RessourceRepository::class)]
#[ORM\InheritanceType("SINGLE_TABLE")]
// #[DiscriminatorColumn(name: 'discr', type: 'string')]
#[ORM\DiscriminatorMap([
    "activite" => Activite::class,
    "cours" => Cours::class
])]
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

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $descriptionR = null;

    #[ORM\Column(length: 50)]
    private ?string $matiereR = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'ressources')]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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

    public function getDescriptionR(): ?string
    {
        return $this->descriptionR;
    }

    public function setDescriptionR(?string $descriptionR): static
    {
        $this->descriptionR = $descriptionR;

        return $this;
    }

    public function getMatiereR(): ?string
    {
        return $this->matiereR;
    }

    public function setMatiereR(string $matiereR): static
    {
        $this->matiereR = $matiereR;

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
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->users->removeElement($user);

        return $this;
    }
}