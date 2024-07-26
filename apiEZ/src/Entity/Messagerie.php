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
    #[ORM\Column( nullable: true)]
    private ?int $id = null;

   

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'messagerie', orphanRemoval: true)]
    private Collection $users;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    private ?message $messages = null;

   

 

    public function __construct()
    {
      
        $this->users = new ArrayCollection();
     
      
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $user->setMessagerie($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getMessagerie() === $this) {
                $user->setMessagerie(null);
            }
        }

        return $this;
    }

    public function getMessages(): ?message
    {
        return $this->messages;
    }

    public function setMessages(?message $messages): static
    {
        $this->messages = $messages;

        return $this;
    }

   

   
}