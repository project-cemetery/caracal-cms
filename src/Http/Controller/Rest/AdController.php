<?php

namespace App\Http\Controller\Rest;

use App\Http\Annotation\HttpCodeCreated\HttpCodeCreated;
use App\Http\Pagination\Page;
use App\Http\Pagination\Pagination;
use App\Http\Pagination\Paginator;
use App\Http\Response\EmptySuccess\EmptySuccessResponse;
use App\Http\Response\Item\AdResponse;
use App\Sale\Ad;
use App\Sale\AdRepository;
use App\Sale\Managing\AdCreateCommand;
use App\Sale\Managing\AdDeleteCommand;
use App\Sale\Managing\AdEditCommand;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

/** @Route("/rest/ads") */
class AdController
{
    /** @Route("/", methods={"GET"}) */
    public function getList(Pagination $pagination, Paginator $paginator): Page
    {
        $ads = array_map(
            function (Ad $ad): AdResponse {
                return AdResponse::fromEntity($ad);
            },
            $paginator->find(Ad::class, $pagination)
        );

        $totalAds = $paginator->getCount(Ad::class);

        return new Page($ads, $pagination, $totalAds);
    }

    /** @Route("/{id}", methods={"GET"}) */
    public function get(Ad $ad): AdResponse
    {
        return AdResponse::fromEntity($ad);
    }

    /** @Route("/{id}", methods={"PUT"}) */
    public function put(AdEditCommand $command, MessageBusInterface $bus, AdRepository $repo): AdResponse
    {
        $bus->dispatch($command);

        $id = $command->getData()->getId();

        return AdResponse::fromEntity(
            $repo->get($id)
        );
    }

    /**
     * @Route("/", methods={"POST"})
     * @HttpCodeCreated()
     */
    public function post(AdCreateCommand $command, MessageBusInterface $bus, AdRepository $repo): AdResponse
    {
        $bus->dispatch($command);

        $id = $command->getData()->getId();

        return AdResponse::fromEntity(
            $repo->get($id)
        );
    }

    /** @Route("/{id}", methods={"DELETE"}) */
    public function delete(AdDeleteCommand $command, MessageBusInterface $bus): EmptySuccessResponse
    {
        $bus->dispatch($command);

        return new EmptySuccessResponse();
    }
}
