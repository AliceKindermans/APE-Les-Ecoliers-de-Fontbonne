<?php

namespace App\Entity;

use Vich\Uploadable;
use App\Entity\Association;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ImageRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;



#[ORM\Entity(repositoryClass: ImageRepository::class)]
#[Vich\Uploadable]


class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'image', cascade: ['persist', 'remove'])]
    private Collection $user;

    #[ORM\ManyToMany(targetEntity: Association::class, inversedBy: 'images')]
    private Collection $Association;

    #[ORM\ManyToMany(targetEntity: Event::class, inversedBy: 'images')]
    private Collection $event;

    #[ORM\ManyToOne(inversedBy: 'image', targetEntity: Pub::class)]
    private ?Pub $pub = null;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->Association = new ArrayCollection();
        $this->event = new ArrayCollection();
    
    }

    public function getId(): ?int
    {
        return $this->id;
    }



     /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): static
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->Association->removeElement($user);

        return $this;
    }

    /**
     * @return Collection<int, Association>
     */
    public function getAssociation(): Collection
    {
        return $this->Association;
    }

    public function addAssociation(Association $association): static
    {
        if (!$this->Association->contains($association)) {
            $this->Association->add($association);
        }

        return $this;
    }

    public function removeAssociation(Association $association): static
    {
        $this->Association->removeElement($association);

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvent(): Collection
    {
        return $this->event;
    }

    public function addEvent(Event $event): static
    {
        if (!$this->event->contains($event)) {
            $this->event->add($event);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        $this->event->removeElement($event);

        return $this;
    }

    public function getPub(): ?Pub
    {
        return $this->pub;
    }

    public function setPub(?Pub $pub): static
    {
        $this->pub = $pub;

        return $this;
    }

    
   
    #[ORM\Column(nullable: true)]
    #[Assert\Length(min:2, max:255)]
    private ?string $imageName = null;

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }
    
    #[Vich\UploadableField(mapping: 'uploadedImages', fileNameProperty: 'ImageName')]
    private ?File $imageFile = null;

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


    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;
    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
 
    }

}

