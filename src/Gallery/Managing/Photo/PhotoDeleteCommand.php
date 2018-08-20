<?php

namespace App\Gallery\Managing\Photo;

use App\Command\DeleteCommand;

class PhotoDeleteCommand implements DeleteCommand
{
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    /** @var string */
    private $id;
}
