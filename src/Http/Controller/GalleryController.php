<?php

namespace App\Http\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Http\Pagination\Pagination;
use App\Http\Pagination\Paginator;
use App\Gallery\Gallery;
use App\Http\Pagination\Page;

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
        $gallery = $paginator->find(Gallery::class, $pagination);
        $totalGallery = $paginator->getCount(Gallery::class);

        return new Page($gallery, $pagination, $totalGallery);
    }

    public function get()
    {
    }

    public function post()
    {
    }

    public function put()
    {
    }

    public function delete()
    {
    }
}
