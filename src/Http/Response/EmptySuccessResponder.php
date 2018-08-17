<?php

namespace App\Http\Response;

use Kamyshev\ResponderBundle\Responder\ResponderInterface;
use Kamyshev\ResponderBundle\Responder\ResultMetadata;
use Symfony\Component\HttpFoundation\Response;

class EmptySuccessResponder implements ResponderInterface
{
    /** @psalm-suppress MissingParamType */
    public function supports($result, ResultMetadata $meta): bool
    {
        return $meta->getType() === EmptySuccessResponse::class;
    }

    /** @psalm-suppress MissingParamType */
    public function make($result, ResultMetadata $meta): Response
    {
        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
