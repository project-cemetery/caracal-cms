<?php

namespace App\Gallery\Managing\Photo;

use App\Command\EditCommand;

class PhotoEditCommand implements EditCommand
{
    public function __construct(
        string $id,
        string $link = null,
        string $name = null,
        string $description = null,
        string $galleryId = null
    ) {
        $this->data = new PhotoData($id, $name, $description, $link, $galleryId);
    }

    public function getData(): PhotoData
    {
        return $this->data;
    }

    /** @var PhotoData */
    private $data;
}
