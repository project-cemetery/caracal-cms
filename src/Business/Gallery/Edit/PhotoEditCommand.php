<?php

namespace App\Business\Gallery\Edit;

use App\Business\Gallery\PhotoData;
use App\Command\EditCommand;

class PhotoEditCommand extends EditCommand
{
    public static function fromData(PhotoData $data): self
    {
        return new self($data);
    }

    public function getData(): PhotoData
    {
        return $this->data;
    }
}
