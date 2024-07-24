<?php

namespace App\Entity;

use App\Repository\ParentsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParentsRepository::class)]
class Parents
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $lastNameP = null;

    #[ORM\Column(length: 50)]
    private ?string $firstNameP = null;

    #[ORM\Column(length: 50)]
    private ?string $mailP = null;

    #[ORM\Column(length: 50)]
    private ?string $passP = null;

    #[ORM\Column(length: 20)]
    private ?string $telephoneP = null;

    #[ORM\Column(length: 50)]
    private ?string $adresseP = null;

    #[ORM\ManyToOne(inversedBy: 'parents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Messagerie $messagerie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastNameP(): ?string
    {
        return $this->lastNameP;
    }

    public function setLastNameP(string $lastNameP): static
    {
        $this->lastNameP = $lastNameP;

        return $this;
    }

    public function getFirstNameP(): ?string
    {
        return $this->firstNameP;
    }

    public function setFirstNameP(string $firstNameP): static
    {
        $this->firstNameP = $firstNameP;

        return $this;
    }

    public function getMailP(): ?string
    {
        return $this->mailP;
    }

    public function setMailP(string $mailP): static
    {
        $this->mailP = $mailP;

        return $this;
    }

    public function getPassP(): ?string
    {
        return $this->passP;
    }

    public function setPassP(string $passP): static
    {
        $this->passP = $passP;

        return $this;
    }

    public function getTelephoneP(): ?string
    {
        return $this->telephoneP;
    }

    public function setTelephoneP(string $telephoneP): static
    {
        $this->telephoneP = $telephoneP;

        return $this;
    }

    public function getAdresseP(): ?string
    {
        return $this->adresseP;
    }

    public function setAdresseP(string $adresseP): static
    {
        $this->adresseP = $adresseP;

        return $this;
    }

    public function getMessagerie(): ?Messagerie
    {
        return $this->messagerie;
    }

    public function setMessagerie(?Messagerie $messagerie): static
    {
        $this->messagerie = $messagerie;

        return $this;
    }
}
