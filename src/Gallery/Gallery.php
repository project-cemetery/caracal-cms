<?php

namespace App\Gallery;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Util\NanoId;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Gallery
{
    // Constructors

    public static function createEmpty(): self
    {
        $instance = new self();

        $instance->id = NanoId::get();

        return $instance;
    }

    public static function create(string $name, string $description): self
    {
        $instance = self::createEmpty();

        $instance->name = $name;
        $instance->description = $description;

        return $instance;
    }

    // Behaviour

    public function rename(string $newName): void
    {
        $this->name = $newName;
    }

    public function changeDescription(string $newDescription): void
    {
        $this->description = $newDescription;
    }

    public function addPhoto(Photo $photo): void
    {
        if ($this->photos->contains($photo)) {
            return;
        }

        $this->photos->add($photo);

        $photo->moveToGallery($this);
    }

    public function removePhoto(Photo $photo): void
    {
        if (!$this->photos->contains($photo)) {
            return;
        }

        $this->photos->removeElement($photo);

        $photo->removeFromGallery();
    }

    // Data

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPhotos(): array
    {
        return $this->photos->toArray();
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    // Internal

    public function __construct()
    {
        $this->photos = new ArrayCollection();
        
        $this->defineCreatedAtValue();
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=32)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="gallery")
     */
    private $photos;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @ORM\PrePersist
     */
    private function defineCreatedAtValue()
    {
        if (!$this->createdAt) {
            $this->createdAt = new \DateTimeImmutable();
        }
    }
}