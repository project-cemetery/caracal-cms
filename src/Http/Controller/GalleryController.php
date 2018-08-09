<?php

namespace App\Http\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Pagination\Pagination;
use App\Http\Pagination\Paginator;
use App\Gallery\Gallery;

/**
 * @Route("/api/gallery")
 */
class GalleryController
{
    /**
     * @Route("/")
     */
    public function getList(Pagination $pagination, Paginator $paginator): Response
    {
        $g = $paginator->find(Gallery::class, $pagination);

        var_dump($g);

        return new Response('hello!');
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
