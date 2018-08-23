<?php

namespace App\Business\Gallery\Managing\Photo;

use App\Command\CreateCommand;

class PhotoCreateCommand extends CreateCommand
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
