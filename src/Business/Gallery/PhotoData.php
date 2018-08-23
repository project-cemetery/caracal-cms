<?php

namespace App\Business\Gallery;

class PhotoData
{
    public function __construct(string $id, ?string $name, ?string $description, ?string $link, ?string $galleryId)
    {
        $this->id = $id;

        $this->name = $name;
        $this->description = $description;
        $this->link = $link;
        $this->galleryId = $galleryId;
    }

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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function getGalleryId(): ?string
    {
        return $this->galleryId;
    }

    public function updatePhoto(Photo $photo, GalleryRepository $galleryRepo): void
    {
        $newName = $this->getName();
        if (!is_null($newName)) {
            $photo->rename($newName);
        }

        $newDescription = $this->getDescription();
        if (!is_null($newDescription)) {
            $photo->changeDescription($newDescription);
        }

        $newLink = $this->getLink();
        if (!is_null($newLink)) {
            $photo->changeLink($newLink);
        }

        $newGalleryId = $this->getGalleryId();
        if (!is_null($newGalleryId)) {
            $newGallery = $galleryRepo->get($newGalleryId);
            $photo->moveToGallery($newGallery);
        }
    }

    /** @var string */
    private $id;
    /** @var null|string */
    private $name;
    /** @var null|string */
    private $description;
    /** @var null|string */
    private $link;
    /** @var null|string */
    private $galleryId;
}
