<?php


namespace App\Service\ObjectStorageClient;


use GuzzleHttp\Client;

class DigitalOceanSpacesClient implements ObjectStorageClient
{
    // DO config
    private $bucket;
    private $region;

    private $httpClient;

    public function __construct(string $bucket, string $region, Client $httpClient)
    {
        $this->bucket = $bucket;
        $this->region = $region;

        $this->httpClient = $httpClient;
    }

    public function upload(string $file)
    {
        $objectKey = $this->objectKey($file);
        $url = "{$this->bucket}.{$this->region}.digitaloceanspaces.com/{$objectKey}";

        $headers = ['Content-Length' => mb_strlen($file)];

        $response = $this->httpClient->put($url, $headers);

        return $objectKey;
    }

    private function objectKey(string $file): string
    {
        return md5($file);
    }
}