<?php

namespace App\Tests\Gallery\Managing\Gallery;

use App\Business\Gallery\Managing\Gallery\GalleryDeleteCommand;
use PHPUnit\Framework\TestCase;

class GalleryDeleteCommandTest extends TestCase
{
    public function testGetId()
    {
        $command = new GalleryDeleteCommand('1');

        $this->assertEquals('1', $command->getId());
    }
}
