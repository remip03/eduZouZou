<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours extends Ressource
{
    #[ORM\Column(length: 50, nullable: true)]
    #[Groups(['getRessources'])]
    private ?string $docC = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['getRessources'])]
    private ?string $videoC = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Groups(['getRessources'])]
    private ?string $ressourceSupC = null;


    public function getDocC(): ?string
    {
        return $this->docC;
    }

    public function setDocC(?string $docC): static
    {
        $this->docC = $docC;

        return $this;
    }

    public function getVideoC(): ?string
    {
        return $this->videoC;
    }

    public function setVideoC(?string $videoC): static
    {
        $this->videoC = $videoC;

        return $this;
    }

    public function getRessourceSupC(): ?string
    {
        return $this->ressourceSupC;
    }

    public function setRessourceSupC(?string $resourceSupC): static
    {
        $this->ressourceSupC = $resourceSupC;

        return $this;
    }
}
