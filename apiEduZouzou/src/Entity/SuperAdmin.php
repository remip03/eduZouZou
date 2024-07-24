<?php

namespace App\Entity;

use App\Repository\SuperAdminRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SuperAdminRepository::class)]
class SuperAdmin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $lastNameSA = null;

    #[ORM\Column(length: 50)]
    private ?string $firstNameSA = null;

    #[ORM\Column(length: 50)]
    private ?string $mailSA = null;

    #[ORM\Column(length: 60)]
    private ?string $passSA = null;

    #[ORM\Column(length: 20)]
    private ?string $telephoneSA = null;

    #[ORM\Column(length: 50)]
    private ?string $adresseSA = null;

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
}
