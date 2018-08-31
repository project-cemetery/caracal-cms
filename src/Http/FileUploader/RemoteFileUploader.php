<?php


namespace App\Http\FileUploader;


use App\Service\ObjectStorageClient\ObjectStorageClient;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class RemoteFileUploader implements FileUploader
{
    private $storageClient;

    public function __construct(ObjectStorageClient $storageClient)
    {
        $this->storageClient = $storageClient;
    }

    public function upload(UploadedFile $file): string
    {
        return '';
    }
}