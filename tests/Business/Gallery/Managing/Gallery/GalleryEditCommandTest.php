<?php

namespace App\Tests\Gallery\Managing\Gallery;

use App\Business\Gallery\Managing\Gallery\GalleryData;
use App\Business\Gallery\Managing\Gallery\GalleryEditCommand;
use PHPUnit\Framework\TestCase;

class GalleryEditCommandTest extends TestCase
{
    public function testGetData()
    {
        $command = new GalleryEditCommand(
            new GalleryData('1')
        );

        $this->assertEquals('1', $command->getData()->getId());
    }
}
