<?php

namespace App\Http\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Gallery\Photo;
use App\Http\Pagination\Page;
use App\Http\Pagination\Pagination;
use App\Http\Pagination\Paginator;
use App\Http\Response\PhotoResponse;

/**
 * @Route("/api/photo")
 */
class PhotoController
{
    /**
     * @Route("/")
     */
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

    /**
     * @Route("/{id}")
     */
    public function get(Photo $photo): PhotoResponse
    {
        return PhotoResponse::fromEntity($photo);
    }
}
