<?php

namespace App\Entity;

use App\Repository\MessagerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessagerieRepository::class)]
class Messagerie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $messages = null;

   
    /**
     * @var Collection<int, Message>
     */
    #[ORM\OneToMany(targetEntity: Message::class, mappedBy: 'messagerie')]
    private Collection $messagess;

    public function __construct()
    {
      
        $this->messagess = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessages(): ?string
    {
        return $this->messages;
    }

    public function setMessages(?string $messages): static
    {
        $this->messages = $messages;

        return $this;
    }

   

    /**
     * @return Collection<int, Message>
     */
    public function getMessagess(): Collection
    {
        return $this->messagess;
    }

    public function addMessagess(Message $messagess): static
    {
        if (!$this->messagess->contains($messagess)) {
            $this->messagess->add($messagess);
            $messagess->setMessagerie($this);
        }

        return $this;
    }

    public function removeMessagess(Message $messagess): static
    {
        if ($this->messagess->removeElement($messagess)) {
            // set the owning side to null (unless already changed)
            if ($messagess->getMessagerie() === $this) {
                $messagess->setMessagerie(null);
            }
        }

        return $this;
    }
}
