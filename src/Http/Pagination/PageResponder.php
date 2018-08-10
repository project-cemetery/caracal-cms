<?php

namespace App\Http\Pagination;
use Symfony\Component\HttpFoundation\Response;
use Kamyshev\ResponderBundle\Responder\ResponderInterface;
use Kamyshev\ResponderBundle\Responder\ResultMetadata;

class PageResponder implements ResponderInterface
{
    public function supports($page, ResultMetadata $meta): bool
    {
        return Page::class === $meta->getType();
    }

    public function make($page, ResultMetadata $meta): Response
    {
        return new Response(42);
    }
}
