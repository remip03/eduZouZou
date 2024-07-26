<?php

namespace App\Entity;

use App\Repository\EcoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EcoleRepository::class)]
class Ecole
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nameEc = null;

    #[ORM\Column(length: 100)]
    private ?string $adresseEc = null;

    #[ORM\Column(length: 20)]
    private ?string $telEc = null;

    #[ORM\Column(length: 60)]
    private ?string $mailEc = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'ecole', orphanRemoval: true)]
    private Collection $users;

    /**
     * @var Collection<int, Classe>
     */
    #[ORM\OneToMany(targetEntity: Classe::class, mappedBy: 'ecole', orphanRemoval: true)]
    private Collection $classes;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->classes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameEc(): ?string
    {
        return $this->nameEc;
    }

    public function setNameEc(string $nameEc): static
    {
        $this->nameEc = $nameEc;

        return $this;
    }

    public function getAdresseEc(): ?string
    {
        return $this->adresseEc;
    }

    public function setAdresseEc(string $adresseEc): static
    {
        $this->adresseEc = $adresseEc;

        return $this;
    }

    public function getTelEc(): ?string
    {
        return $this->telEc;
    }

    public function setTelEc(string $telEc): static
    {
        $this->telEc = $telEc;

        return $this;
    }

    public function getMailEc(): ?string
    {
        return $this->mailEc;
    }

    public function setMailEc(string $mailEc): static
    {
        $this->mailEc = $mailEc;

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
            $user->setEcole($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getEcole() === $this) {
                $user->setEcole(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Classe>
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classe $class): static
    {
        if (!$this->classes->contains($class)) {
            $this->classes->add($class);
            $class->setEcole($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): static
    {
        if ($this->classes->removeElement($class)) {
            // set the owning side to null (unless already changed)
            if ($class->getEcole() === $this) {
                $class->setEcole(null);
            }
        }

        return $this;
    }
}
