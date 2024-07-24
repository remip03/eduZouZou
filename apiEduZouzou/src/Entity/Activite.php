<?php

namespace App\Entity;

use App\Repository\ActiviteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActiviteRepository::class)]
class Activite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $descriptionAct = null;

    #[ORM\Column(length: 50)]
    private ?string $typeAct = null;

    #[ORM\Column(length: 50)]
    private ?string $matiereAct = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescriptionAct(): ?string
    {
        return $this->descriptionAct;
    }

    public function setDescriptionAct(?string $descriptionAct): static
    {
        $this->descriptionAct = $descriptionAct;

        return $this;
    }

    public function getTypeAct(): ?string
    {
        return $this->typeAct;
    }

    public function setTypeAct(string $typeAct): static
    {
        $this->typeAct = $typeAct;

        return $this;
    }

    public function getMatiereAct(): ?string
    {
        return $this->matiereAct;
    }

    public function setMatiereAct(string $matiereAct): static
    {
        $this->matiereAct = $matiereAct;

        return $this;
    }
}
