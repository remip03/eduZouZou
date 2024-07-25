<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
class Admin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["getSA"])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(["getSA"])]
    private ?string $lastNameA = null;

    #[ORM\Column(length: 50)]
    #[Groups(["getSA"])]
    private ?string $firstNameA = null;

    #[ORM\Column(length: 50)]
    #[Groups(["getSA"])]
    private ?string $mailA = null;

    #[ORM\Column(length: 60)]
    #[Groups(["getSA"])]
    private ?string $passA = null;

    #[ORM\Column(length: 20)]
    #[Groups(["getSA"])]
    private ?string $telephoneA = null;

    #[ORM\Column(length: 50)]
    #[Groups(["getSA"])]
    private ?string $adresseA = null;

    #[ORM\ManyToOne(inversedBy: 'admins')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ecole $ecole = null;

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
