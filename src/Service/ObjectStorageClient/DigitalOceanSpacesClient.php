<?php

namespace App\Service\ObjectStorageClient;

use App\Service\ObjectStorageClient\Exception\UnknownObjectStorageClientException;
use Aws\S3\S3Client;

class DigitalOceanSpacesClient implements ObjectStorageClient
{
    // DO config
    /** @var string */
    private $bucket;
    /** @var string */
    private $region;
    /** @var string */
    private $apiKey;
    /** @var string */
    private $secretKey;

    /** @var S3Client */
    private $s3client;

    public function __construct(
        string $bucket,
        string $region,
        string $apiKey,
        string $secretKey
    ) {
        $this->bucket = $bucket;
        $this->region = $region;
        $this->apiKey = $apiKey;
        $this->secretKey = $secretKey;

        $this->s3client = new S3Client([
            'version'     => 'latest',
            'endpoint'    => "https://{$this->region}.digitaloceanspaces.com",
            'region'      => $this->region,
            'credentials' => [
                'key'    => $this->apiKey,
                'secret' => $this->secretKey,
            ],
        ]);
    }

    public function upload(string $filePath, string $extension, string $visibility = self::VISIBILITY_PRIVATE): string
    {
        $file = file_get_contents($filePath);
        $fileName = md5($file);

        $response = $this->s3client->upload(
            $this->bucket,
            "{$fileName}.{$extension}",
            $file,
            $visibility
        );

        if (!isset($response['ObjectURL'])) {
            throw new UnknownObjectStorageClientException();
        }

        $objectUrl = $response['ObjectURL'];

        if (!$objectUrl || mb_strlen($objectUrl) < 1) {
            throw new UnknownObjectStorageClientException();
        }

        return $objectUrl;
    }
}
