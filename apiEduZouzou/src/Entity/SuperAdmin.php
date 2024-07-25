<?php

namespace App\Entity;

use App\Repository\SuperAdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SuperAdminRepository::class)]
class SuperAdmin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups(["getSA"])]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(["getSA"])]
    private ?string $lastNameSA = null;

    #[ORM\Column(length: 50)]
    #[Groups(["getSA"])]
    private ?string $firstNameSA = null;

    #[ORM\Column(length: 50)]
    #[Groups(["getSA"])]
    private ?string $mailSA = null;

    #[ORM\Column(length: 60)]
    #[Groups(["getSA"])]
    private ?string $passSA = null;

    #[ORM\Column(length: 20)]
    #[Groups(["getSA"])]
    private ?string $telephoneSA = null;

    #[ORM\Column(length: 50)]
    #[Groups(["getSA"])]
    private ?string $adresseSA = null;

    /**
     * @var Collection<int, Ecole>
     */
    #[ORM\OneToMany(targetEntity: Ecole::class, mappedBy: 'superAdmin', orphanRemoval: true)]
    private Collection $ecoles;

    public function __construct()
    {
        $this->ecoles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastNameSA(): ?string
    {
        return $this->lastNameSA;
    }

    public function setLastNameSA(string $lastNameSA): static
    {
        $this->lastNameSA = $lastNameSA;

        return $this;
    }

    public function getFirstNameSA(): ?string
    {
        return $this->firstNameSA;
    }

    public function setFirstNameSA(string $firstNameSA): static
    {
        $this->firstNameSA = $firstNameSA;

        return $this;
    }

    public function getMailSA(): ?string
    {
        return $this->mailSA;
    }

    public function setMailSA(string $mailSA): static
    {
        $this->mailSA = $mailSA;

        return $this;
    }

    public function getPassSA(): ?string
    {
        return $this->passSA;
    }

    public function setPassSA(string $passSA): static
    {
        $this->passSA = $passSA;

        return $this;
    }

    public function getTelephoneSA(): ?string
    {
        return $this->telephoneSA;
    }

    public function setTelephoneSA(string $telephoneSA): static
    {
        $this->telephoneSA = $telephoneSA;

        return $this;
    }

    public function getAdresseSA(): ?string
    {
        return $this->adresseSA;
    }

    public function setAdresseSA(string $adresseSA): static
    {
        $this->adresseSA = $adresseSA;

        return $this;
    }

    /**
     * @return Collection<int, Ecole>
     */
    public function getEcoles(): Collection
    {
        return $this->ecoles;
    }

    public function addEcole(Ecole $ecole): static
    {
        if (!$this->ecoles->contains($ecole)) {
            $this->ecoles->add($ecole);
            $ecole->setSuperAdmin($this);
        }

        return $this;
    }

    public function removeEcole(Ecole $ecole): static
    {
        if ($this->ecoles->removeElement($ecole)) {
            // set the owning side to null (unless already changed)
            if ($ecole->getSuperAdmin() === $this) {
                $ecole->setSuperAdmin(null);
            }
        }

        return $this;
    }
}