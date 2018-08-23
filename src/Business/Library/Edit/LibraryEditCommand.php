<?php

namespace App\Business\Library\Edit;

use App\Business\Library\LibraryData;
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
