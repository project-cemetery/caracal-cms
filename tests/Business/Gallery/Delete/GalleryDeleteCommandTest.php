<?php

namespace App\Tests\Gallery\Delete;

use App\Business\Gallery\Delete\GalleryDeleteCommand;
use PHPUnit\Framework\TestCase;

class GalleryDeleteCommandTest extends TestCase
{
    public function testGetId()
    {
        $command = new GalleryDeleteCommand('1');

        $this->assertEquals('1', $command->getId());
    }
}
