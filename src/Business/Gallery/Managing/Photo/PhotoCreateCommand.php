<?php

namespace App\Business\Gallery\Managing\Photo;

use App\Command\CreateCommand;

class PhotoCreateCommand implements CreateCommand
{
    public function __construct(
        string $id,
        string $link,
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
