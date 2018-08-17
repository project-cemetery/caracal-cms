<?php

namespace App\Http\Response;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Kamyshev\ResponderBundle\Responder\{ResponderInterface, ResultMetadata};

class ItemResponder implements ResponderInterface
{
    /** @var SerializerInterface */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /** @psalm-suppress MissingParamType */
    public function supports($response, ResultMetadata $meta): bool
    {
        return is_subclass_of($response, ItemResponse::class);
    }

    /** @psalm-suppress MissingParamType */
    public function make($response, ResultMetadata $meta): Response
    {
        $data = $this->serializer->serialize([
            'item' => $response,
        ], 'json');

        return JsonResponse::fromJsonString($data);
    }
}
