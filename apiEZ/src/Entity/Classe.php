<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation\Groups;

/**
 * @Hateoas\Relation(
 *     "self",
 *     href = @Hateoas\Route(
 *         "detailClasse",
 *         parameters = { "id" = "expr(object.getId())" },
 *     ),
 *     exclusion = @Hateoas\Exclusion(groups = "getClasses"),
 * )
 * 
 * @Hateoas\Relation(
 *    "delete",
 *   href = @Hateoas\Route(
 *      "deleteClasse",
 *     parameters = { "id" = "expr(object.getId())" },
 *     ),
 *     exclusion = @Hateoas\Exclusion(groups = "getClasses", excludeIf = "expr(not is_granted('ROLE_ADMIN'))"),
 * )
 * 
 * @Hateoas\Relation(
 *    "update",
 *   href = @Hateoas\Route(
 *      "updateClasse",
 *     parameters = { "id" = "expr(object.getId())" },
 *     ),
 *     exclusion = @Hateoas\Exclusion(groups = "getClasses", excludeIf = "expr(not is_granted('ROLE_ADMIN'))"),
 * )
 * 
 */
#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['getClasses'])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(['getClasses'])]
    #[Assert\NotBlank(message: 'Le nom de la classe est obligatoire')]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: "Le nom de la classe doit contenir au moins {{ limit }} caractères.",
        maxMessage: "Le nom de la classe ne peut pas contenir plus de {{ limit }} caractères."
    )]
    private ?string $nameCl = null;

    #[ORM\Column(length: 50)]
    #[Groups(['getClasses'])]
    private ?string $niveauCl = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    #[Groups(['getClasses'])]
    private ?\DateTimeImmutable $anneeCl = null;

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
    
    // public function getEcole(): ?Ecole
    // {
    //     return $this->ecole;
    // }

    // public function setEcole(?Ecole $ecole): static
    // {
    //     $this->ecole = $ecole;
    //     return $this;
    // }
}