<?php

namespace App\Entity;

use App\Repository\RessourceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation\Groups;

/**
 * @Hateoas\Relation(
 *     "self",
 *     href = @Hateoas\Route(
 *         "detailRessource",
 *         parameters = { "id" = "expr(object.getId())" },
 *     ),
 *     exclusion = @Hateoas\Exclusion(groups = "getRessources"),
 * )
 * 
 * @Hateoas\Relation(
 *    "delete",
 *   href = @Hateoas\Route(
 *      "deleteRessource",
 *     parameters = { "id" = "expr(object.getId())" },
 *     ),
 *     exclusion = @Hateoas\Exclusion(groups = "getRessources", excludeIf = "expr(not is_granted('ROLE_ADMIN'))"),
 * )
 * 
 * @Hateoas\Relation(
 *    "update",
 *   href = @Hateoas\Route(
 *      "updateRessource",
 *     parameters = { "id" = "expr(object.getId())" },
 *     ),
 *     exclusion = @Hateoas\Exclusion(groups = "getRessources", excludeIf = "expr(not is_granted('ROLE_ADMIN'))"),
 * )
 * 
 */

#[ORM\Entity(repositoryClass: RessourceRepository::class)]
#[ORM\InheritanceType("SINGLE_TABLE")]
// #[DiscriminatorColumn(name: 'discr', type: 'string')]
#[ORM\DiscriminatorMap([
    "activite" => Activite::class,
    "cours" => Cours::class
])]
abstract class Ressource
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['getRessources'])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(['getRessources'])]
    #[Assert\NotBlank(message: 'Veuillez choisir entre "Cours" et "Activité".')]
    private ?string $typeR = null;

    #[ORM\Column(length: 50)]
    #[Groups(['getRessources'])]
    #[Assert\NotBlank(message: 'Le nom du cours ou de l\'activité est obligatoire')]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: "Le nom doit contenir au moins {{ limit }} caractères.",
        maxMessage: "Le nom ne peut pas contenir plus de {{ limit }} caractères."
    )]
    private ?string $nameR = null;

    #[ORM\Column(length: 500, nullable: true)]
    #[Groups(['getRessources'])]
    #[Assert\length(
        max: 500,
        maxMessage: "La description ne peut pas contenir plus de {{ limit }} caractères"
    )]
    private ?string $descriptionR = null;

    #[ORM\Column(length: 50)]
    #[Groups(['getRessources'])]
    private ?string $matiereR = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'ressources')]
    #[Groups(['getRessources'])]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeR(): ?string
    {
        return $this->typeR;
    }

    public function setTypeR(string $typeR): static
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

    public function getDescriptionR(): ?string
    {
        return $this->descriptionR;
    }

    public function setDescriptionR(?string $descriptionR): static
    {
        $this->descriptionR = $descriptionR;

        return $this;
    }

    public function getMatiereR(): ?string
    {
        return $this->matiereR;
    }

    public function setMatiereR(string $matiereR): static
    {
        $this->matiereR = $matiereR;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->users->removeElement($user);

        return $this;
    }
}
