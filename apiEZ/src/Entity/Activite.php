<?php

namespace App\Entity;

use App\Repository\ActiviteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActiviteRepository::class)]
class Activite extends Ressource
{

    #[ORM\Column(length: 50)]
    private ?string $typeAct = null;


    public function getTypeAct(): ?string
    {
        return $this->typeAct;
    }

    public function setTypeAct(string $typeAct): static
    {
        $this->typeAct = $typeAct;

        return $this;
    }
}
