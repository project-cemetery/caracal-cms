<?php

namespace App\Http\Response;

use App\Gallery\Gallery;
use App\Gallery\Photo;

class GalleryResponse
{
    public static function fromEntity(Gallery $gallery): self
    {
        $photoResponses = array_map(
            function (Photo $photo): PhotoResponse {
                return PhotoResponse::fromEntity($photo);
            },
            $gallery->getPhotos()
        );

        return new self(
            $gallery->getId(),
            $gallery->getName() ?? '',
            $gallery->getDescription() ?? '',
            $gallery->getCreatedAt(),
            $photoResponses
        );
    }

    public function __construct(
        string $id,
        string $name,
        string $description,
        \DateTimeImmutable $createdAt,
        iterable $photos
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->createdAt = $createdAt;

        $this->photos = (function (PhotoResponse ...$photos): iterable {
            return $photos;
        })(...$photos);
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

    public function getPhotos(): iterable
    {
        return $this->photos;
    }

    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $description;

    /** @var \DateTimeImmutable */
    private $createdAt;

    /** @var PhotoResponse[] */
    private $photos;
}