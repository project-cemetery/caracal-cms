<?php

namespace App\Business\Gallery\Edit;

use App\Business\Gallery\GalleryData;
use App\Command\EditCommand;

class GalleryEditCommand extends EditCommand
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
