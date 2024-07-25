<?php

namespace App\Entity;

use App\Repository\EcoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EcoleRepository::class)]
class Ecole
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups(["getEcoles"])]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(["getEcoles"])]
    private ?string $nameEc = null;

    #[ORM\Column(length: 100)]
    #[Groups(["getEcoles"])]
    private ?string $adresseEc = null;

    #[ORM\Column(length: 20)]
    #[Groups(["getEcoles"])]
    private ?string $telEc = null;

    #[ORM\Column(length: 50)]
    #[Groups(["getEcoles"])]
    private ?string $mailEc = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'ecole', orphanRemoval: true)]
    private Collection $Users;

    public function __construct()
    {
        $this->Users = new ArrayCollection();
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
        return $this->Users;
    }

    public function addUser(User $user): static
    {
        if (!$this->Users->contains($user)) {
            $this->Users->add($user);
            $user->setEcole($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->Users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getEcole() === $this) {
                $user->setEcole(null);
            }
        }

        return $this;
    }


}
