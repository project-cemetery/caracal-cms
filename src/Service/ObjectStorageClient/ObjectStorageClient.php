<?php

namespace App\Service\ObjectStorageClient;

interface ObjectStorageClient
{
    public function upload(string $filePath, string $extension): string;
}
