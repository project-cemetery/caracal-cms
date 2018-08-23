<?php

namespace App\Business\Sale\Managing;

use App\Command\EditCommand;

class AdEditCommand extends EditCommand
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
