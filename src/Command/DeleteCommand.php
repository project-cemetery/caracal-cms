<?php

namespace App\Command;

abstract class DeleteCommand implements Command
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
