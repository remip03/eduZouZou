<?php

namespace App\Entity;

use App\Repository\EnfantRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation\Groups;

/**
 * @Hateoas\Relation(
 *     "self",
 *     href = @Hateoas\Route(
 *         "detailEnfant",
 *         parameters = { "id" = "expr(object.getId())" },
 *     ),
 *     exclusion = @Hateoas\Exclusion(groups = "getClasses"),
 * )
 * 
 * @Hateoas\Relation(
 *    "delete",
 *   href = @Hateoas\Route(
 *      "deleteEnfant",
 *     parameters = { "id" = "expr(object.getId())" },
 *     ),
 *     exclusion = @Hateoas\Exclusion(groups = "getClasses", excludeIf = "expr(not is_granted('ROLE_ADMIN'))"),
 * )
 * 
 * @Hateoas\Relation(
 *    "update",
 *   href = @Hateoas\Route(
 *      "updateEnfant",
 *     parameters = { "id" = "expr(object.getId())" },
 *     ),
 *     exclusion = @Hateoas\Exclusion(groups = "getClasses", excludeIf = "expr(not is_granted('ROLE_ADMIN'))"),
 * )
 * 
 */
#[ORM\Entity(repositoryClass: EnfantRepository::class)]
class Enfant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['getClasses'])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(['getClasses'])]
    #[Assert\NotBlank(message: 'Le nom de l\'enfant est obligatoire')]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: "Le nom de l'enfant doit contenir au moins {{ limit }} caractères.",
        maxMessage: "Le nom de l'enfant ne peut pas contenir plus de {{ limit }} caractères."
    )]
    private ?string $lastNameE = null;

    #[ORM\Column(length: 50)]
    #[Groups(['getClasses'])]
    #[Assert\NotBlank(message: 'Le prénom de l\'enfant est obligatoire')]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: "Le prénom de l'enfant doit contenir au moins {{ limit }} caractères.",
        maxMessage: "Le prénom de l'enfant ne peut pas contenir plus de {{ limit }} caractères."
    )]
    private ?string $firstNameE = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    #[Groups(['getClasses'])]
    #[Assert\NotBlank(message: 'La date de naissance de l\'enfant est obligatoire')]
    private ?\DateTimeImmutable $birthDateE = null;

    #[ORM\ManyToOne(targetEntity: Classe::class ,inversedBy: "Enfants")]
    #[Groups(['getClasses'])]
    private? Classe $classe = null;

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
