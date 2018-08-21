<?php

namespace App\Command;

interface DeleteCommand extends Command
{
    public function getId(): string;
}
