<?php

namespace App\Util;

use Hidehalo\Nanoid\Client;

class NanoId
{
    private const ID_LENGTH = 21;

    public static function get(): string
    {
        $client = new Client();

        return $client->generateId(self::ID_LENGTH);
    }
}
