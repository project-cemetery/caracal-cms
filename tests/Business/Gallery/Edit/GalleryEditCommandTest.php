<?php

namespace App\Tests\Gallery\Edit;

use App\Business\Gallery\Edit\GalleryEditCommand;
use App\Business\Gallery\GalleryData;
use PHPUnit\Framework\TestCase;

class GalleryEditCommandTest extends TestCase
{
    public function testGetData()
    {
        $command = GalleryEditCommand::fromData(
            new GalleryData('1')
        );

        $this->assertEquals('1', $command->getData()->getId());
    }
}
