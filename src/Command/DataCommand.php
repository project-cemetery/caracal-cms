<?php

namespace App\Command;

abstract class DataCommand implements Command
{
    /** @psalm-suppress MissingParamType */
    protected function __construct($data)
    {
        $this->data = $data;
    }

    /** @var mixed */
    protected $data;
}
