<?php

namespace App\Util;

use Hidehalo\Nanoid\Client;

class NanoId
{
    public static function get(): string
    {
        $client = new Client();

        return $client->generateId(21);
    }
}
