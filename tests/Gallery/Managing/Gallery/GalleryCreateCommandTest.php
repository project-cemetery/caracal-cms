<?php


namespace App\Tests\Gallery\Managing\Gallery;


use App\Gallery\Managing\Gallery\GalleryCreateCommand;
use PHPUnit\Framework\TestCase;

class GalleryCreateCommandTest extends TestCase
{
    public function testGetData()
    {
        $command = new GalleryCreateCommand('1');

        $this->assertEquals('1', $command->getData()->getId());
    }
}