<?php

namespace App\Entity;

use App\Repository\EnfantRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnfantRepository::class)]
class Enfant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $lastNameE = null;

    #[ORM\Column(length: 50)]
    private ?string $firstNameE = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $birthDateE = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastNameE(): ?string
    {
        return $this->lastNameE;
    }

    public function setLastNameE(string $lastNameE): static
    {
        $this->lastNameE = $lastNameE;

        return $this;
    }

    public function getFirstNameE(): ?string
    {
        return $this->firstNameE;
    }

    public function setFirstNameE(string $firstNameE): static
    {
        $this->firstNameE = $firstNameE;

        return $this;
    }

    public function getBirthDateE(): ?\DateTimeImmutable
    {
        return $this->birthDateE;
    }

    public function setBirthDateE(\DateTimeImmutable $birthDateE): static
    {
        $this->birthDateE = $birthDateE;

        return $this;
    }
}
