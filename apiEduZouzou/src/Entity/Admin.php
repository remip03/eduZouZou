<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
class Admin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $lastNameA = null;

    #[ORM\Column(length: 50)]
    private ?string $firstNameA = null;

    #[ORM\Column(length: 50)]
    private ?string $mailA = null;

    #[ORM\Column(length: 60)]
    private ?string $passA = null;

    #[ORM\Column(length: 20)]
    private ?string $telephoneA = null;

    #[ORM\Column(length: 50)]
    private ?string $adresseA = null;

    /**
     * @var Collection<int, Classe>
     */
    #[ORM\OneToMany(targetEntity: Classe::class, mappedBy: 'adminclasse', orphanRemoval: true)]
    private Collection $classes;

    #[ORM\ManyToOne(inversedBy: 'admins')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ecole $ecole = null;

    public function __construct()
    {
        $this->classes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastNameA(): ?string
    {
        return $this->lastNameA;
    }

    public function setLastNameA(string $lastNameA): static
    {
        $this->lastNameA = $lastNameA;

        return $this;
    }

    public function getFirstNameA(): ?string
    {
        return $this->firstNameA;
    }

    public function setFirstNameA(string $firstNameA): static
    {
        $this->firstNameA = $firstNameA;

        return $this;
    }

    public function getMailA(): ?string
    {
        return $this->mailA;
    }

    public function setMailA(string $mailA): static
    {
        $this->mailA = $mailA;

        return $this;
    }

    public function getPassA(): ?string
    {
        return $this->passA;
    }

    public function setPassA(string $passA): static
    {
        $this->passA = $passA;

        return $this;
    }

    public function getTelephoneA(): ?string
    {
        return $this->telephoneA;
    }

    public function setTelephoneA(string $telephoneA): static
    {
        $this->telephoneA = $telephoneA;

        return $this;
    }

    public function getAdresseA(): ?string
    {
        return $this->adresseA;
    }

    public function setAdresseA(string $adresseA): static
    {
        $this->adresseA = $adresseA;

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
            $class->setAdminclasse($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): static
    {
        if ($this->classes->removeElement($class)) {
            // set the owning side to null (unless already changed)
            if ($class->getAdminclasse() === $this) {
                $class->setAdminclasse(null);
            }
        }

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
