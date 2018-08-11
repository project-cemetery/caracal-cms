<?php

namespace App\Http\Pagination;
use Symfony\Component\HttpFoundation\Response;
use Kamyshev\ResponderBundle\Responder\ResponderInterface;
use Kamyshev\ResponderBundle\Responder\ResultMetadata;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class PageResponder implements ResponderInterface
{
    /** @var SerializerInterface $serializer */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function supports($page, ResultMetadata $meta): bool
    {
        return Page::class === $meta->getType();
    }

    public function make($page, ResultMetadata $meta): Response
    {
        $page = $this->pageHinted($page);

        $serialized = $this->serializer->serialize($page, 'json');

        return new JsonResponse($serialized);
    }

    private function pageHinted($page): Page
    {
        return $page;
    }
}
