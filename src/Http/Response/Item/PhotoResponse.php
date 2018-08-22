<?php

namespace App\Http\Response\Item;

use App\Gallery\Photo;

class PhotoResponse implements ItemResponse
{
    public static function fromEntity(Photo $photo): self
    {
        $galleryId = $photo->getGallery()
            ? $photo->getGallery()->getId()
            : null;

        return new self(
            $photo->getId(),
            $photo->getName() ?? '',
            $photo->getDescription() ?? '',
            $photo->toLink(),
            $galleryId
        );
    }

    public function __construct(
        string $id,
        string $name,
        string $description,
        string $link,
        ?string $galleryId = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->link = $link;
        $this->galleryId = $galleryId;
    }

    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $description;

    /** @var string */
    private $link;

    /** @var string|null */
    private $galleryId;
}
