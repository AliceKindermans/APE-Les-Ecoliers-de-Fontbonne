<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToOne(inversedBy: 'image', cascade: ['persist', 'remove'])]
    private ?User $relation = null;

    #[ORM\ManyToMany(targetEntity: Association::class, inversedBy: 'images')]
    private Collection $Association;

    #[ORM\ManyToMany(targetEntity: Event::class, inversedBy: 'images')]
    private Collection $event;

    public function __construct()
    {
        $this->Association = new ArrayCollection();
        $this->event = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getRelation(): ?User
    {
        return $this->relation;
    }

    public function setRelation(?User $relation): static
    {
        $this->relation = $relation;

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
}
