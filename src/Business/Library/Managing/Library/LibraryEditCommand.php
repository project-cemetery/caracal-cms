<?php

namespace App\Business\Library\Managing\Library;

use App\Command\EditCommand;

class LibraryEditCommand implements EditCommand
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
