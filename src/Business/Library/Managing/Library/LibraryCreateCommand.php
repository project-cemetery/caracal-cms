<?php

namespace App\Business\Library\Managing\Library;

use App\Command\CreateCommand;

class LibraryCreateCommand implements CreateCommand
{
    public static function fromData(LibraryData $data): self
    {
        $instance = new self();

        $instance->data = $data;

        return $instance;
    }

    public function getData(): LibraryData
    {
        return $this->data;
    }

    /** @var LibraryData */
    private $data;
}
