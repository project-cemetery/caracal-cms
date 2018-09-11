<?php

namespace App\Http\FileUploader;

use App\Service\ObjectStorageClient\ObjectStorageClient;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class RemoteFileUploader implements FileUploader
{
    /** @var ObjectStorageClient */
    private $storageClient;

    public function __construct(ObjectStorageClient $storageClient)
    {
        $this->storageClient = $storageClient;
    }

    public function upload(UploadedFile $file): string
    {
        return $this->storageClient->upload(
            $file->getRealPath(),
            $file->guessExtension() ?? $file->getExtension(),
            ObjectStorageClient::VISIBILITY_PUBLIC
        );
    }
}
