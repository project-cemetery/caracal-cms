<?php

namespace App\Business\Sale\Managing;

use App\Command\EditCommand;

class AdEditCommand implements EditCommand
{
    public function __construct(
        string $id,
        string $name = null,
        string $body = null,
        array $images = null,
        \DateTimeImmutable $expireAt = null,
        bool $published = null,
        bool $eternal = null
    ) {
        $this->data = new AdData($id, $name, $body, $images, $expireAt, $published, $eternal);
    }

    public function getData(): AdData
    {
        return $this->data;
    }

    /** @var AdData */
    private $data;
}
