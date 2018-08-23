<?php

namespace App\Business\Gallery\Managing\Gallery;

use App\Command\EditCommand;

class GalleryEditCommand implements EditCommand
{
    public function __construct(GalleryData $data)
    {
        $this->data = $data;
    }

    public function getData(): GalleryData
    {
        return $this->data;
    }

    /** @var GalleryData */
    private $data;
}
