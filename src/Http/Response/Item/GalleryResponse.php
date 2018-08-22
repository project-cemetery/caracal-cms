<?php

namespace App\Http\Response\Item;

use App\Gallery\Gallery;
use App\Gallery\Photo;

class GalleryResponse implements ItemResponse
{
    public static function fromEntity(Gallery $gallery): self
    {
        $photoIds = array_map(
            function (Photo $photo): string {
                return $photo->getId();
            },
            $gallery->getPhotos()
        );

        return new self(
            $gallery->getId(),
            $gallery->getName() ?? '',
            $gallery->getDescription() ?? '',
            $gallery->getCreatedAt(),
            $photoIds
        );
    }

    public function __construct(
        string $id,
        string $name,
        string $description,
        \DateTimeImmutable $createdAt,
        iterable $photoIds
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->createdAt = $createdAt;

        $this->photoIds = (function (string ...$photoIds): array {
            return $photoIds;
        })(...$photoIds);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getPhotoIds(): array
    {
        return $this->photoIds;
    }

    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $description;

    /** @var \DateTimeImmutable */
    private $createdAt;

    /** @var string[] */
    private $photoIds;
}
