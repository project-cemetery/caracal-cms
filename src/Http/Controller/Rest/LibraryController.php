<?php

namespace App\Http\Controller\Rest;

use App\Business\Library\Create\LibraryCreateCommand;
use App\Business\Library\Delete\LibraryDeleteCommand;
use App\Business\Library\Edit\LibraryEditCommand;
use App\Http\Annotation\AdminAccess\AdminAccess;
use App\Http\Annotation\HttpCodeCreated\HttpCodeCreated;
use App\Http\Pagination\Page;
use App\Http\Pagination\Pagination;
use App\Http\Pagination\Paginator;
use App\Http\Response\EmptySuccess\EmptySuccessResponse;
use App\Http\Response\Item\LibraryResponse;
use App\Business\Library\Library;
use App\Business\Library\LibraryRepository;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

/** @Route("/rest/libraries") */
class LibraryController
{
    /** @Route("/", methods={"GET"}) */
    public function getList(Pagination $pagination, Paginator $paginator): Page
    {
        $libraries = array_map(
            function (Library $library): LibraryResponse {
                return LibraryResponse::fromEntity($library);
            },
            $paginator->find(Library::class, $pagination)
        );

        $totalLibraries = $paginator->getCount(Library::class);

        return new Page($libraries, $pagination, $totalLibraries);
    }

    /** @Route("/{id}", methods={"GET"}) */
    public function get(Library $article): LibraryResponse
    {
        return LibraryResponse::fromEntity($article);
    }

    /**
     * @Route("/{id}", methods={"PUT"})
     * @AdminAccess()
     */
    public function put(
        LibraryEditCommand $command,
        MessageBusInterface $bus,
        LibraryRepository $repo
    ): LibraryResponse {
        $bus->dispatch($command);

        $id = $command->getData()->getId();

        return LibraryResponse::fromEntity(
            $repo->get($id)
        );
    }

    /**
     * @Route("/", methods={"POST"})
     * @HttpCodeCreated()
     * @AdminAccess()
     */
    public function post(
        LibraryCreateCommand $command,
        MessageBusInterface $bus,
        LibraryRepository $repo
    ): LibraryResponse {
        $bus->dispatch($command);

        $id = $command->getData()->getId();

        return LibraryResponse::fromEntity(
            $repo->get($id)
        );
    }

    /**
     * @Route("/{id}", methods={"DELETE"})
     * @AdminAccess()
     */
    public function delete(LibraryDeleteCommand $command, MessageBusInterface $bus): EmptySuccessResponse
    {
        $bus->dispatch($command);

        return new EmptySuccessResponse();
    }
}
