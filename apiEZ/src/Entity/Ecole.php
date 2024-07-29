<?php

namespace App\Entity;

use App\Repository\EcoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Hateoas\Configuration\Annotation as Hateoas;

/**
 * @Hateoas\Relation(
 *     "self",
 *     href = @Hateoas\Route(
 *         "detailEcole",
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

#[ORM\Entity(repositoryClass: EcoleRepository::class)]
class Ecole
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["getClasses"])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(["getClasses"])]
    #[Assert\NotBlank(message: "Le nom de l'école est obligatoire.")]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: "Le nom de l'école doit contenir au moins {{ limit }} caractères.",
        maxMessage: "Le nom de l'école ne peut pas contenir plus de {{ limit }} caractères."
    )]
    private ?string $nameEc = null;

    #[ORM\Column(length: 100)]
    #[Groups(["getClasses"])]
    #[Assert\NotBlank(message: 'L\'adresse de l\'école est obligatoire')]
    #[Assert\Length(
        min: 2,
        max: 100,
        minMessage: "L'adresse de l'école doit contenir au moins {{ limit }} caractères.",
        maxMessage: "L'adresse de l'école ne peut pas contenir plus de {{ limit }} caractères."
    )]
    private ?string $adresseEc = null;

    #[ORM\Column(length: 20)]
    #[Groups(["getClasses"])]
    #[Assert\NotBlank(message: 'Le numéro de téléphone de l\'école est obligatoire')]
    #[Assert\Length(
        min: 8,
        max: 20,
        minMessage: "Le numéro de téléphone de l'école doit contenir au moins {{ limit }} caractères.",
        maxMessage: "Le numéro de téléphone de l'école ne peut pas contenir plus de {{ limit }} caractères."
    )]
    private ?string $telEc = null;

    #[ORM\Column(length: 60)]
    #[Groups(["getClasses"])]
    #[Assert\NotBlank(message: 'L\'adresse mail de l\'école est obligatoire')]
    #[Assert\Length(
        min: 2,
        max: 60,
        minMessage: "L'adresse mail de l'école doit contenir au moins {{ limit }} caractères.",
        maxMessage: "L'adresse mail de l'école ne peut pas contenir plus de {{ limit }} caractères."
    )]
    private ?string $mailEc = null;

    /**
     * @var Collection<int, Classe>
     */
    #[ORM\OneToMany(targetEntity: Classe::class, mappedBy: 'ecole', cascade: ['remove'])]
    private Collection $Classes;

    public function __construct()
    {
        $this->Classes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameEc(): ?string
    {
        return $this->nameEc;
    }

    public function setNameEc(string $nameEc): static
    {
        $this->nameEc = $nameEc;

        return $this;
    }

    public function getAdresseEc(): ?string
    {
        return $this->adresseEc;
    }

    public function setAdresseEc(string $adresseEc): static
    {
        $this->adresseEc = $adresseEc;

        return $this;
    }

    public function getTelEc(): ?string
    {
        return $this->telEc;
    }

    public function setTelEc(string $telEc): static
    {
        $this->telEc = $telEc;

        return $this;
    }

    public function getMailEc(): ?string
    {
        return $this->mailEc;
    }

    public function setMailEc(string $mailEc): static
    {
        $this->mailEc = $mailEc;

        return $this;
    }

    /**
     * @return Collection<int, Classe>
     */
    public function getClasses(): Collection
    {
        return $this->Classes;
    }

    public function addClasse(Classe $classe): static
    {
        if (!$this->Classes->contains($classe)) {
            $this->Classes->add($classe);
            $classe->setEcole($this);
        }

        return $this;
    }

    public function removeClasse(Classe $classe): static
    {
        if ($this->Classes->removeElement($classe)) {
            // set the owning side to null (unless already changed)
            if ($classe->getEcole() === $this) {
                $classe->setEcole(null);
            }
        }
        return $this;
    }
}
