<?php

namespace App\Business\Gallery\Managing\Gallery;

use App\Business\Gallery\Gallery;
use App\Business\Gallery\PhotoRepository;

class GalleryData
{
    public function __construct(string $id, string $name = null, string $description = null, array $photoIds = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;

        $this->photoIds = is_null($photoIds)
            ? null
            : (function (string ...$photoIds): array {
                return $photoIds;
            })(...$photoIds);
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

    public function getPhotoIds(): ?array
    {
        return $this->photoIds;
    }

    public function updateGallery(Gallery $gallery, PhotoRepository $photoRepo): void
    {
        $newName = $this->getName();
        if (!is_null($newName)) {
            $gallery->rename($newName);
        }

        $newDescription = $this->getDescription();
        if (!is_null($newDescription)) {
            $gallery->changeDescription($newDescription);
        }

        $newPhotoIds = $this->getPhotoIds();
        if (!is_null($newPhotoIds)) {
            $newPhotos = $photoRepo->getAllByIds($newPhotoIds);
            $gallery->updatePhotos($newPhotos);
        }
    }

    /** @var string */
    private $id;
    /** @var string|null */
    private $name;
    /** @var string|null */
    private $description;
    /** @var array|null */
    private $photoIds;
}
