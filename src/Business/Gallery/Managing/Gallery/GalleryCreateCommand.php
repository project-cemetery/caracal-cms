<?php

namespace App\Business\Gallery\Managing\Gallery;

use App\Command\CreateCommand;

class GalleryCreateCommand extends CreateCommand
{
    public static function fromData(GalleryData $data): self
    {
        return new self($data);
    }

    public function getData(): GalleryData
    {
        return $this->data;
    }
}
