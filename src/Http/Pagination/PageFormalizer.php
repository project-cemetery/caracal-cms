<?php

namespace App\Http\Pagination;

use App\Http\ResponseFormalizer\ResponseFormalizerInterface;
use App\Http\ResponseFormalizer\ResponseMetadata;
use Symfony\Component\HttpFoundation\Response;


class PageFormalizer implements ResponseFormalizerInterface
{
    public function supports($page, ResponseMetadata $meta): bool
    {
        return Page::class === $meta->getType();
    }

    public function make($page, ResponseMetadata $meta): Response
    {
        return new Response(42);
    }
}