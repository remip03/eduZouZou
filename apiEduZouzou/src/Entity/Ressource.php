<?php

namespace App\Entity;

use App\Repository\RessourceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RessourceRepository::class)]
class Ressource
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $typeR = null;

    #[ORM\Column(length: 50)]
    private ?string $nameR = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isTypeR(): ?bool
    {
        return $this->typeR;
    }

    public function setTypeR(bool $typeR): static
    {
        $this->typeR = $typeR;

        return $this;
    }

    public function getNameR(): ?string
    {
        return $this->nameR;
    }

    public function setNameR(string $nameR): static
    {
        $this->nameR = $nameR;

        return $this;
    }
}
