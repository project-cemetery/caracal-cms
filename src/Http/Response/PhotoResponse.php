<?php

namespace App\Http\Response;

use App\Gallery\Photo;

class PhotoResponse implements ItemResponse
{
    public static function fromEntity(Photo $photo): self
    {
        return new self(
            $photo->getId(),
            $photo->getName() ?? '',
            $photo->getDescription() ?? '',
            $photo->toLink()
        );
    }

    public function __construct(
        string $id,
        string $name,
        string $description,
        string $link
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->link = $link;
    }

    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $description;

    /** @var string */
    private $link;
}
