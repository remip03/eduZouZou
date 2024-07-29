<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups(['getMessages'])]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['getMessages'])]
    #[ORM\Column(length: 500)]
    private ?string $content = null;

    #[Groups(['getMessages'])]
    #[ORM\Column(length: 50)]
    private ?string $destinataire = null;

    #[Groups(['getMessages'])]
    #[ORM\Column(length: 50)]
    private ?string $expediteur = null;

    /**
     * @var Collection<int, Messagerie>
     */
    #[ORM\OneToMany(targetEntity: Messagerie::class, mappedBy: 'messages')]
    private Collection $messages;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
    }







    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getDestinataire(): ?string
    {
        return $this->destinataire;
    }

    public function setDestinataire(string $destinataire): static
    {
        $this->destinataire = $destinataire;

        return $this;
    }

    public function getExpediteur(): ?string
    {
        return $this->expediteur;
    }

    public function setExpediteur(string $expediteur): static
    {
        $this->expediteur = $expediteur;

        return $this;
    }

    /**
     * @return Collection<int, Messagerie>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Messagerie $message): static
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setMessages($this);
        }

        return $this;
    }

    public function removeMessage(Messagerie $message): static
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getMessages() === $this) {
                $message->setMessages(null);
            }
        }

        return $this;
    }
}
