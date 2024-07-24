<?php

namespace App\Entity;

use App\Repository\EcoleRepository;
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
    private ?string $telephoneEc = null;

    #[ORM\Column(length: 50)]
    private ?string $mailEc = null;

    #[ORM\ManyToOne(inversedBy: 'ecoles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SuperAdmin $superAdmin = null;

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

    public function getTelephoneEc(): ?string
    {
        return $this->telephoneEc;
    }

    public function setTelephoneEc(string $telephoneEc): static
    {
        $this->telephoneEc = $telephoneEc;

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

    public function getSuperAdmin(): ?SuperAdmin
    {
        return $this->superAdmin;
    }

    public function setSuperAdmin(?SuperAdmin $superAdmin): static
    {
        $this->superAdmin = $superAdmin;

        return $this;
    }
}
