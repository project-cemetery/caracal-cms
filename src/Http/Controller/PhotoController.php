<?php

namespace App\Http\Controller;

use App\Gallery\Photo;
use App\Http\Pagination\Page;
use App\Http\Pagination\Pagination;
use App\Http\Pagination\Paginator;
use App\Http\Response\PhotoResponse;
use Symfony\Component\Routing\Annotation\Route;

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
}
