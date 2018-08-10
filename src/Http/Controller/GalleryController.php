<?php

namespace App\Http\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
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
    public function getList(Pagination $pagination, Paginator $paginator)
    {
        $g = $paginator->find(Gallery::class, $pagination);

        return new Page($g, $pagination);
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
