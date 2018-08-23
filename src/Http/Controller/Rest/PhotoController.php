<?php

namespace App\Http\Controller\Rest;

use App\Business\Gallery\Create\PhotoCreateCommand;
use App\Business\Gallery\Delete\PhotoDeleteCommand;
use App\Business\Gallery\Edit\PhotoEditCommand;
use App\Business\Gallery\PhotoRepository;
use App\Http\Response\EmptySuccess\EmptySuccessResponse;
use App\Http\Annotation\HttpCodeCreated\HttpCodeCreated;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Business\Gallery\Photo;
use App\Http\Pagination\Page;
use App\Http\Pagination\Pagination;
use App\Http\Pagination\Paginator;
use App\Http\Response\Item\PhotoResponse;

/** @Route("/rest/photos") */
class PhotoController
{
    /** @Route("/", methods={"GET"}) */
    public function getList(Pagination $pagination, Paginator $paginator): Page
    {
        $photos = array_map(
            function (Photo $photo): PhotoResponse {
                return PhotoResponse::fromEntity($photo);
            },
            $paginator->find(Photo::class, $pagination)
        );

        $totalPhotos = $paginator->getCount(Photo::class);

        return new Page($photos, $pagination, $totalPhotos);
    }

    /** @Route("/{id}", methods={"GET"}) */
    public function get(Photo $photo): PhotoResponse
    {
        return PhotoResponse::fromEntity($photo);
    }

    /** @Route("/{id}", methods={"PUT"}) */
    public function put(PhotoEditCommand $command, MessageBusInterface $bus, PhotoRepository $repo): PhotoResponse
    {
        $bus->dispatch($command);

        $id = $command->getData()->getId();

        return PhotoResponse::fromEntity(
            $repo->get($id)
        );
    }

    /**
     * @Route("/", methods={"POST"})
     * @HttpCodeCreated()
     */
    public function post(PhotoCreateCommand $command, MessageBusInterface $bus, PhotoRepository $repo): PhotoResponse
    {
        $bus->dispatch($command);

        $id = $command->getData()->getId();

        return PhotoResponse::fromEntity(
            $repo->get($id)
        );
    }

    /** @Route("/{id}", methods={"DELETE"}) */
    public function delete(PhotoDeleteCommand $command, MessageBusInterface $bus): EmptySuccessResponse
    {
        $bus->dispatch($command);

        return new EmptySuccessResponse();
    }
}
