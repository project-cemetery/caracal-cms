<?php

namespace App\Library\Managing\Library;

use App\Command\EditCommand;

class LibraryEditCommand implements EditCommand
{
    public function __construct(
        string $id,
        string $name = null,
        string $description = null,
        string $parentId = null,
        array $articleIds = null
    ) {
        $this->data = new LibraryData($id, $name, $description, $parentId, $articleIds);
    }

    public function getData(): LibraryData
    {
        return $this->data;
    }

    /** @var LibraryData */
    private $data;
}
