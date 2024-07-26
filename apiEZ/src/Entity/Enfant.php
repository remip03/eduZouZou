<?php

namespace App\Entity;

use App\Repository\EnfantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnfantRepository::class)]
class Enfant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstNameE = null;

    #[ORM\Column(length: 50)]
    private ?string $lastNameE = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $birthDateE = null;

    #[ORM\ManyToOne(inversedBy: 'Enfants')]
    private ?Classe $classe = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLastNameE(): ?string
    {
        return $this->lastNameE;
    }

    public function setLastNameE(string $lastNameE): static
    {
        $this->lastNameE = $lastNameE;

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

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): static
    {
        $this->classe = $classe;

        return $this;
    }
}
