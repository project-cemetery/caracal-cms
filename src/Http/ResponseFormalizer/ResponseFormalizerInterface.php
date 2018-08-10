<?php

namespace App\Http\ResponseFormalizer;

use Symfony\Component\HttpFoundation\Response;

interface ResponseFormalizerInterface
{
    public function supports($result, ResponseMetadata $meta): bool;

    public function make($result, ResponseMetadata $meta): Response;
}
