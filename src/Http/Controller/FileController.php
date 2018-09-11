<?php

namespace App\Http\Controller;

use App\Http\Annotation\AdminAccess\AdminAccess;
use App\Http\FileUploader\FileUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FileController
{
    /**
     * @Route("/upload", methods={"PUT"})
     * @AdminAccess()
     */
    public function upload(UploadedFile $file, FileUploader $fileUploader): Response
    {
        $fileUrl = $fileUploader->upload($file);

        return new Response($fileUrl);
    }
}
