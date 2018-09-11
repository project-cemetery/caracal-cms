<?php

namespace App\Service\ObjectStorageClient;

interface ObjectStorageClient
{
    const VISIBILITY_PRIVATE = 'private';
    const VISIBILITY_PUBLIC = 'public-read';

    public function upload(string $filePath, string $extension, string $visibility = self::VISIBILITY_PRIVATE): string;
}
