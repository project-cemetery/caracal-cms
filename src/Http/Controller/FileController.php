<?php


namespace App\Http\Controller;


use App\Http\Annotation\AdminAccess\AdminAccess;
use App\Http\FileUploader\FileUploader;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FileController
{
    /**
     * @Route("/upload")
     * @AdminAccess()
     */
    public function upload(FileUploader $fileUploader)
    {
        return new Response('ok');
    }
}