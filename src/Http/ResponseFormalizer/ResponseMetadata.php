<?php

namespace App\Http\ResponseFormalizer;

class ResponseMetadata
{
    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    private $type;
}
