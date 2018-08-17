<?php

namespace App\Http\Controller;

use App\Editor\GalleryEditCommand;
use Symfony\Component\Routing\Annotation\Route;
use App\Http\Pagination\Pagination;
use App\Http\Pagination\Paginator;
use App\Gallery\Gallery;
use App\Http\Pagination\Page;
use App\Http\Response\GalleryResponse;

/** @Route("/api/gallery") */
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
    public function post(GalleryEditCommand $editCommand): GalleryResponse
    {
        return new GalleryResponse(
            $editCommand->getId(),
            $editCommand->getName(),
            $editCommand->getDescription(),
            $editCommand->getCreateAt() ?? new \DateTimeImmutable(),
            []
        );
    }
}
