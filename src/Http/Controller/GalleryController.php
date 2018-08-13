<?php

namespace App\Http\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Http\Pagination\Pagination;
use App\Http\Pagination\Paginator;
use App\Gallery\Gallery;
use App\Http\Pagination\Page;
use App\Http\Response\GalleryResponse;

/**
 * @Route("/api/gallery")
 */
class GalleryController
{
    /**
     * @Route("/")
     */
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
}
