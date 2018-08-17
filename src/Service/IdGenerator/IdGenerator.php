<?php


namespace App\Service\IdGenerator;


interface IdGenerator
{
    public function generate(): string;
}