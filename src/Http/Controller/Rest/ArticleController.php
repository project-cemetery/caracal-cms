<?php

namespace App\Http\Controller\Rest;

use App\Http\Annotation\HttpCodeCreated\HttpCodeCreated;
use App\Http\Pagination\Page;
use App\Http\Pagination\Pagination;
use App\Http\Pagination\Paginator;
use App\Http\Response\EmptySuccess\EmptySuccessResponse;
use App\Http\Response\Item\ArticleResponse;
use App\Library\Article;
use App\Library\ArticleRepository;
use App\Library\Managing\Article\ArticleCreateCommand;
use App\Library\Managing\Article\ArticleDeleteCommand;
use App\Library\Managing\Article\ArticleEditCommand;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

/** @Route("/rest/articles") */
class ArticleController
{
    /** @Route("/", methods={"GET"}) */
    public function getList(Pagination $pagination, Paginator $paginator): Page
    {
        $articles = array_map(
            function (Article $article): ArticleResponse {
                return ArticleResponse::fromEntity($article);
            },
            $paginator->find(Article::class, $pagination)
        );

        $totalArticles = $paginator->getCount(Article::class);

        return new Page($articles, $pagination, $totalArticles);
    }

    /** @Route("/{id}", methods={"GET"}) */
    public function get(Article $article): ArticleResponse
    {
        return ArticleResponse::fromEntity($article);
    }

    /** @Route("/{id}", methods={"PUT"}) */
    public function put(
        ArticleEditCommand $command,
        MessageBusInterface $bus,
        ArticleRepository $repo
    ): ArticleResponse {
        $bus->dispatch($command);

        $id = $command->getData()->getId();

        return ArticleResponse::fromEntity(
            $repo->get($id)
        );
    }

    /**
     * @Route("/", methods={"POST"})
     * @HttpCodeCreated()
     */
    public function post(
        ArticleCreateCommand $command,
        MessageBusInterface $bus,
        ArticleRepository $repo
    ): ArticleResponse {
        $bus->dispatch($command);

        $id = $command->getData()->getId();

        return ArticleResponse::fromEntity(
            $repo->get($id)
        );
    }

    /** @Route("/{id}", methods={"DELETE"}) */
    public function delete(ArticleDeleteCommand $command, MessageBusInterface $bus): EmptySuccessResponse
    {
        $bus->dispatch($command);

        return new EmptySuccessResponse();
    }
}
