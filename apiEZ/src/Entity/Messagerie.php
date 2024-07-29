<?php

namespace App\Entity;

use App\Repository\MessagerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MessagerieRepository::class)]
class Messagerie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups(['getMessageries'])]
    #[ORM\Column( nullable: true)]
    private ?int $id = null;



    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'messagerie')]
    private Collection $users;

    #[ORM\ManyToOne(inversedBy: 'messages',cascade:['remove'])]
    private ?Message $messages = null;





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
