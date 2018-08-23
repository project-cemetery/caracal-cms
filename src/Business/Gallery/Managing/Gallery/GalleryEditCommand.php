<?php

namespace App\Business\Gallery\Managing\Gallery;

use App\Command\EditCommand;

class GalleryEditCommand implements EditCommand
{
    public static function fromData(GalleryData $data): self
    {
        $instance = new self();

        $instance->data = $data;

        return $instance;
    }

    public function getData(): GalleryData
    {
        return $this->data;
    }

    /** @var GalleryData */
    private $data;
}
