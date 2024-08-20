<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
#[Vich\Uploadable]
class Cours extends Ressource
{
    #[ORM\Column(length: 50, nullable: true)]
    #[Groups(['getRessources'])]
    private ?string $docC = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['getRessources'])]
    private ?string $videoC = null;

    // NOTE: This is not a mapped field of entity metadata, just a simple property.
    #[Vich\UploadableField(mapping: 'cours_images', fileNameProperty: 'ressourceSupC')]
    private ?File $imageFile = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Groups(['getRessources'])]
    private ?string $ressourceSupC = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getDocC(): ?string
    {
        return $this->docC;
    }

    public function setDocC(?string $docC): static
    {
        $this->docC = $docC;

        return $this;
    }

    public function getVideoC(): ?string
    {
        return $this->videoC;
    }

    public function setVideoC(?string $videoC): static
    {
        $this->videoC = $videoC;

        return $this;
    }

        /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getRessourceSupC(): ?string
    {
        return $this->ressourceSupC;
    }

    public function setRessourceSupC(?string $resourceSupC): static
    {
        $this->ressourceSupC = $resourceSupC;

        return $this;
    }
}
