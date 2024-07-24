<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\DBAL\Types\Types;
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

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $anneeCl = null;

    #[ORM\ManyToOne(inversedBy: 'classes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ecole $ecole = null;

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

    public function getAnneeCl(): ?\DateTimeImmutable
    {
        return $this->anneeCl;
    }

    public function setAnneeCl(\DateTimeImmutable $anneeCl): static
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
}
