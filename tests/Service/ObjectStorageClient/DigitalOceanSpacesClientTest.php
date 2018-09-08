<?php


namespace App\Tests\Service\ObjectStorageClient;


use App\Service\ObjectStorageClient\DigitalOceanSpacesClient;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class DigitalOceanSpacesClientTest extends TestCase
{
    public function testUpload()
    {
        $guzzle = $this->createMock(Client::class);

        $client = new DigitalOceanSpacesClient('bucket', 'region', $guzzle);

        $image = file_get_contents(__DIR__ . '/assets/image.png');

        $client->upload($image);
    }
}