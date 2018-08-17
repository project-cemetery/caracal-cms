<?php

namespace App\Gallery;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Gallery\GalleryRepository")
 */
class Gallery
{
    // Constructors

    public static function createEmpty(string $id): self
    {
        $instance = new self();

        $instance->id = $id;

        return $instance;
    }

    public static function create(string $id, string $name, string $description): self
    {
        $instance = self::createEmpty($id);

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

    public function updatePhotos(iterable $newPhotos): void
    {
        $newPhotos = (function (Photo ...$newPhotos): array {
            return $newPhotos;
        })(...$newPhotos);

        $oldPhotos = $this->getPhotos();

        foreach ($oldPhotos as $photo) {
            $this->removePhoto($photo);
        }

        foreach ($newPhotos as $photo) {
            $this->addPhoto($photo);
        }
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
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="gallery", cascade={"remove"})
     */
    private $photos;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=false)
     */
    private $createdAt;

    private function defineCreatedAtValue(): void
    {
        if (!$this->createdAt) {
            $this->createdAt = new \DateTimeImmutable();
        }
    }
}
