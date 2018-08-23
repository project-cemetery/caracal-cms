<?php

namespace App\Business\Library\Create;

use App\Business\Library\LibraryData;
use App\Command\CreateCommand;

class LibraryCreateCommand extends CreateCommand
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
