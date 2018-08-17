<?php


namespace App\Service\IdGenerator;


use Hidehalo\Nanoid\Client;

class NanoIdGenerator implements IdGenerator
{
    /** @var Client */
    private $client;

    private const ID_LENGTH = 21;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function generate(): string
    {
        return $this->client->generateId(self::ID_LENGTH);
    }
}