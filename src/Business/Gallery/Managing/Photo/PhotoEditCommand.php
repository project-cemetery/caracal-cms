<?php

namespace App\Business\Gallery\Managing\Photo;

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
