<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $descriptionC = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $docC = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $videoC = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $resourceSupC = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescriptionC(): ?string
    {
        return $this->descriptionC;
    }

    public function setDescriptionC(?string $descriptionC): static
    {
        $this->descriptionC = $descriptionC;

        return $this;
    }

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

    public function getResourceSupC(): ?string
    {
        return $this->resourceSupC;
    }

    public function setResourceSupC(?string $resourceSupC): static
    {
        $this->resourceSupC = $resourceSupC;

        return $this;
    }
}
