<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nameCl = null;

    #[ORM\Column(length: 50)]
    private ?string $niveauCl = null;

    #[ORM\Column(length: 50)]
    private ?string $anneeCl = null;

    #[ORM\ManyToOne(inversedBy: 'classes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ecole $ecole = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'classes')]
    private Collection $users;

    /**
     * @var Collection<int, Enfant>
     */
    #[ORM\OneToMany(targetEntity: Enfant::class, mappedBy: 'classe')]
    private Collection $Enfants;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->Enfants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCl(): ?string
    {
        return $this->nameCl;
    }

    public function setNameCl(?string $nameCl): static
    {
        $this->nameCl = $nameCl;

        return $this;
    }

    public function getNiveauCl(): ?string
    {
        return $this->niveauCl;
    }

    public function setNiveauCl(string $niveauCl): static
    {
        $this->niveauCl = $niveauCl;

        return $this;
    }

    public function getAnneeCl(): ?string
    {
        return $this->anneeCl;
    }

    public function setAnneeCl(string $anneeCl): static
    {
        $this->anneeCl = $anneeCl;

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

    /**
     * @return Collection<int, Enfant>
     */
    public function getEnfants(): Collection
    {
        return $this->Enfants;
    }

    public function addEnfant(Enfant $enfant): static
    {
        if (!$this->Enfants->contains($enfant)) {
            $this->Enfants->add($enfant);
            $enfant->setClasse($this);
        }

        return $this;
    }

    public function removeEnfant(Enfant $enfant): static
    {
        if ($this->Enfants->removeElement($enfant)) {
            // set the owning side to null (unless already changed)
            if ($enfant->getClasse() === $this) {
                $enfant->setClasse(null);
            }
        }

        return $this;
    }
}
