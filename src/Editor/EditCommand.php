<?php

namespace App\Editor;

interface EditCommand
{
    /** @param mixed $entity */
    public function supports($entity): bool;

    public function getId(): string;
}
