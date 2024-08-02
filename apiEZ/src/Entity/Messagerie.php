<?php

namespace App\Entity;

use App\Repository\MessagerieRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MessagerieRepository::class)]
class Messagerie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups(['getClasses'])]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(mappedBy: 'messagerie', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        // set the owning side of the relation if necessary
        if ($user->getMessagerie() !== $this) {
            $user->setMessagerie($this);
        }

        $this->user = $user;

        return $this;
    }

    public function getMessages(): ?Message
    {
        return $this->messages;
    }

    public function setMessages(?Message $messages): static
    {
        $this->messages = $messages;

        return $this;
    }
}
