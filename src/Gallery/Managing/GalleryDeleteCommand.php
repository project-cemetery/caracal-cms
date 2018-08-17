<?php


namespace App\Gallery\Managing;

use App\Command\DeleteCommand;

class GalleryDeleteCommand implements DeleteCommand
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