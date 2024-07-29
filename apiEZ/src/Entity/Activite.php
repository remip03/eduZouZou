<?php

namespace App\Entity;

use App\Repository\ActiviteRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ActiviteRepository::class)]
class Activite extends Ressource
{
    #[ORM\Column(length: 50, nullable: true)]
    #[Groups(['getRessources'])]
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