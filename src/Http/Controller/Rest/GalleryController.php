<?php

namespace App\Http\Controller\Rest;

use App\Business\Gallery\Managing\Gallery\GalleryCreateCommand;
use App\Business\Gallery\Managing\Gallery\GalleryDeleteCommand;
use App\Http\Response\EmptySuccess\EmptySuccessResponse;
use App\Http\Annotation\HttpCodeCreated\HttpCodeCreated;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Business\Gallery\GalleryRepository;
use App\Business\Gallery\Gallery;
use App\Business\Gallery\Managing\Gallery\GalleryEditCommand;
use App\Http\Pagination\Pagination;
use App\Http\Pagination\Paginator;
use App\Http\Pagination\Page;
use App\Http\Response\Item\GalleryResponse;

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

    /** @Route("/{id}", methods={"PUT"}) */
    public function put(
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

    /**
     * @Route("/", methods={"POST"})
     * @HttpCodeCreated()
     */
    public function post(
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
