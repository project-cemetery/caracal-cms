<?php

namespace App\Business\Sale\Managing;

use App\Command\CreateCommand;

class AdCreateCommand implements CreateCommand
{
    public static function fromData(AdData $data): self
    {
        $instance = new self();

        $instance->data = $data;

        return $instance;
    }

    public function getData(): AdData
    {
        return $this->data;
    }

    /** @var AdData */
    private $data;
}
