<?php

namespace App\Command;

interface EditCommand extends Command
{
    /** @param mixed $entity */
    public function supports($entity): bool;

    public function getId(): string;
}
