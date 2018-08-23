<?php

namespace App\Business\Sale\Create;

use App\Business\Sale\AdData;
use App\Command\CreateCommand;

class AdCreateCommand extends CreateCommand
{
    public static function fromData(AdData $data): self
    {
        return new self($data);
    }

    public function getData(): AdData
    {
        return $this->data;
    }
}
