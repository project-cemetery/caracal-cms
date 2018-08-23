<?php

namespace App\Business\Gallery\Managing\Photo;

use App\Command\CreateCommand;

class PhotoCreateCommand implements CreateCommand
{
    public static function fromData(PhotoData $data): self
    {
        $instance = new self();

        $instance->data = $data;

        return $instance;
    }

    public function getData(): PhotoData
    {
        return $this->data;
    }

    /** @var PhotoData */
    private $data;
}
