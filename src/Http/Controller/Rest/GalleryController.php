<?php

namespace App\Http\Controller\Rest;

use App\Gallery\Managing\Gallery\GalleryCreateCommand;
use App\Gallery\Managing\Gallery\GalleryDeleteCommand;
use App\Http\Response\EmptySuccessResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Gallery\GalleryRepository;
use App\Gallery\Gallery;
use App\Gallery\Managing\Gallery\GalleryEditCommand;
use App\Http\Pagination\Pagination;
use App\Http\Pagination\Paginator;
use App\Http\Pagination\Page;
use App\Http\Response\GalleryResponse;

/** @Route("/rest/gallery") */
class GalleryController
{
    /** @Route("/", methods={"GET"}) */
    public function getList(Pagination $pagination, Paginator $paginator): Page
    {
        $gallery = array_map(
            function (Gallery $gallery): GalleryResponse {
                return GalleryResponse::fromEntity($gallery);
            },
            $paginator->find(Gallery::class, $pagination)
        );

        $totalGallery = $paginator->getCount(Gallery::class);

        return new Page($gallery, $pagination, $totalGallery);
    }

    /** @Route("/{id}", methods={"GET"}) */
    public function get(Gallery $gallery): GalleryResponse
    {
        return GalleryResponse::fromEntity($gallery);
    }

    /** @Route("/{id}", methods={"POST"}) */
    public function post(
        GalleryEditCommand $command,
        MessageBusInterface $bus,
        GalleryRepository $repo
    ): GalleryResponse {
        $bus->dispatch($command);

        $id = $command->getData()->getId();

        return GalleryResponse::fromEntity(
            $repo->get($id)
        );
    }

    /** @Route("/", methods={"PUT"}) */
    public function put(
        GalleryCreateCommand $command,
        MessageBusInterface $bus,
        GalleryRepository $repo
    ): GalleryResponse {
        $bus->dispatch($command);

        $id = $command->getData()->getId();

        return GalleryResponse::fromEntity(
            $repo->get($id)
        );
    }

    /** @Route("/{id}", methods={"DELETE"}) */
    public function delete(GalleryDeleteCommand $command, MessageBusInterface $bus): EmptySuccessResponse
    {
        $bus->dispatch($command);

        return new EmptySuccessResponse();
    }
}
