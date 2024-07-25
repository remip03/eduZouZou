<?php

namespace App\Entity;

use App\Repository\EcoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EcoleRepository::class)]
class Ecole
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nameEc = null;

    #[ORM\Column(length: 100)]
    private ?string $adresseEc = null;

    #[ORM\Column(length: 20)]
    private ?string $telephoneEc = null;

    #[ORM\Column(length: 50)]
    private ?string $mailEc = null;

    /**
     * @var Collection<int, Admin>
     */
    #[ORM\OneToMany(targetEntity: Admin::class, mappedBy: 'ecole', orphanRemoval: true)]
    private Collection $admins;

    /**
     * @var Collection<int, Enseignant>
     */
    #[ORM\OneToMany(targetEntity: Enseignant::class, mappedBy: 'ecole', orphanRemoval: true)]
    private Collection $enseignants;

    /**
     * @var Collection<int, Classe>
     */
    #[ORM\OneToMany(targetEntity: Classe::class, mappedBy: 'ecole', orphanRemoval: true)]
    private Collection $classes;

    public function __construct()
    {
        $this->admins = new ArrayCollection();
        $this->enseignants = new ArrayCollection();
        $this->classes = new ArrayCollection();
    }

    /**
     * @var Collection<int, Admin>
     */
    #[ORM\OneToMany(targetEntity: Admin::class, mappedBy: 'ecole')]
    private Collection $admins;

    /**
     * @var Collection<int, Enseignant>
     */
    #[ORM\OneToMany(targetEntity: Enseignant::class, mappedBy: 'ecole')]
    private Collection $enseignants;

    /**
     * @var Collection<int, Classe>
     */
    #[ORM\OneToMany(targetEntity: Classe::class, mappedBy: 'ecole', orphanRemoval: true)]
    private Collection $classes;

    public function __construct()
    {
        $this->admins = new ArrayCollection();
        $this->enseignants = new ArrayCollection();
        $this->classes = new ArrayCollection();
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

    public function getTelephoneEc(): ?string
    {
        return $this->telephoneEc;
    }

    public function setTelephoneEc(string $telephoneEc): static
    {
        $this->telephoneEc = $telephoneEc;

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
     * @return Collection<int, Admin>
     */
    public function getAdmins(): Collection
    {
        return $this->admins;
    }

    public function addAdmin(Admin $admin): static
    {
        if (!$this->admins->contains($admin)) {
            $this->admins->add($admin);
            $admin->setEcole($this);
        }

        return $this;
    }

    public function removeAdmin(Admin $admin): static
    {
        if ($this->admins->removeElement($admin)) {
            // set the owning side to null (unless already changed)
            if ($admin->getEcole() === $this) {
                $admin->setEcole(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Enseignant>
     */
    public function getEnseignants(): Collection
    {
        return $this->enseignants;
    }

    public function addEnseignant(Enseignant $enseignant): static
    {
        if (!$this->enseignants->contains($enseignant)) {
            $this->enseignants->add($enseignant);
            $enseignant->setEcole($this);
        }

        return $this;
    }

    public function removeEnseignant(Enseignant $enseignant): static
    {
        if ($this->enseignants->removeElement($enseignant)) {
            // set the owning side to null (unless already changed)
            if ($enseignant->getEcole() === $this) {
                $enseignant->setEcole(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Classe>
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classe $class): static
    {
        if (!$this->classes->contains($class)) {
            $this->classes->add($class);
            $class->setEcole($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): static
    {
        if ($this->classes->removeElement($class)) {
            // set the owning side to null (unless already changed)
            if ($class->getEcole() === $this) {
                $class->setEcole(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Admin>
     */
    public function getAdmins(): Collection
    {
        return $this->admins;
    }

    public function addAdmin(Admin $admin): static
    {
        if (!$this->admins->contains($admin)) {
            $this->admins->add($admin);
            $admin->setEcole($this);
        }

        return $this;
    }

    public function removeAdmin(Admin $admin): static
    {
        if ($this->admins->removeElement($admin)) {
            // set the owning side to null (unless already changed)
            if ($admin->getEcole() === $this) {
                $admin->setEcole(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Enseignant>
     */
    public function getEnseignants(): Collection
    {
        return $this->enseignants;
    }

    public function addEnseignant(Enseignant $enseignant): static
    {
        if (!$this->enseignants->contains($enseignant)) {
            $this->enseignants->add($enseignant);
            $enseignant->setEcole($this);
        }

        return $this;
    }

    public function removeEnseignant(Enseignant $enseignant): static
    {
        if ($this->enseignants->removeElement($enseignant)) {
            // set the owning side to null (unless already changed)
            if ($enseignant->getEcole() === $this) {
                $enseignant->setEcole(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Classe>
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classe $class): static
    {
        if (!$this->classes->contains($class)) {
            $this->classes->add($class);
            $class->setEcole($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): static
    {
        if ($this->classes->removeElement($class)) {
            // set the owning side to null (unless already changed)
            if ($class->getEcole() === $this) {
                $class->setEcole(null);
            }
        }

        return $this;
    }
}
