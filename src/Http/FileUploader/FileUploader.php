<?php

namespace App\Http\FileUploader;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileUploader
{
    public function upload(UploadedFile $file): string;
}
