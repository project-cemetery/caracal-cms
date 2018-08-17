<?php

namespace App\Gallery;

use Doctrine\ORM\Mapping as ORM;
use App\Util\NanoId;

/**
 * @ORM\Entity(repositoryClass="App\Gallery\PhotoRepository")
 */
class Photo
{
    // Constructors

    public static function createEmpty(string $link): self
    {
        $instance = new self();

        $instance->id = NanoId::get();
        $instance->link = $link;

        return $instance;
    }

    public static function create(string $link, string $name, string $description): self
    {
        $instance = self::createEmpty($link);

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

    public function moveToGallery(Gallery $gallery): void
    {
        if ($this->gallery === $gallery) {
            return;
        }

        if ($this->gallery) {
            $this->gallery->removePhoto($this);
        }

        $this->gallery = $gallery;

        $this->gallery->addPhoto($this);
    }

    public function removeFromGallery(): void
    {
        if (!$this->gallery) {
            return;
        }

        $this->gallery->removePhoto($this);

        $this->gallery = null;
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

    public function toLink(): string
    {
        return $this->link;
    }

    public function getGallery(): ?Gallery
    {
        return $this->gallery;
    }

    // Internal

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
     * @ORM\Column(type="string", length=511, nullable=false)
     */
    private $link;

    /**
     * @ORM\ManyToOne(targetEntity="Gallery", inversedBy="photos")
     * @ORM\JoinColumn(name="gallery_id", referencedColumnName="id")
     */
    private $gallery;
}
