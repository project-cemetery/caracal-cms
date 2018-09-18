<?php

namespace App\Http\Controller;

use App\Http\Annotation\AdminAccess\AdminAccess;
use App\Http\FileUploader\FileUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

class FileController
{
    /**
     * @Route("/upload", methods={"PUT"})
     * @AdminAccess()
     */
    public function upload(UploadedFile $file, FileUploader $fileUploader): Response
    {
        try {
            $fileUrl = $fileUploader->upload($file);

            return new Response($fileUrl);
        } catch (\UnexpectedValueException $e) {
            throw new BadRequestHttpException('Invalid file in request', $e);
        }
    }
}
