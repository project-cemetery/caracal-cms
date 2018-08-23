<?php

namespace App\Business\Library\Managing\Library;

use App\Command\EditCommand;

class LibraryEditCommand extends EditCommand
{
    public static function fromData(LibraryData $data): self
    {
        return new self($data);
    }

    public function getData(): LibraryData
    {
        return $this->data;
    }
}
