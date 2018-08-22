<?php

namespace App\Tests\Gallery\Managing\Gallery;

use App\Business\Gallery\GalleryRepository;
use App\Business\Gallery\Managing\Gallery\GalleryDeleteCommand;
use App\Business\Gallery\Managing\Gallery\GalleryDeleteHandler;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;

class GalleryDeleteHandlerTest extends TestCase
{
    public function testInvoke()
    {
        $command = $this->createMock(GalleryDeleteCommand::class);

        $handler = new GalleryDeleteHandler(
            $this->createEmMock(),
            $this->createMock(GalleryRepository::class)
        );

        $handler($command);
    }

    private function createEmMock()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->setMethods(['remove', 'flush'])
            ->disableOriginalConstructor()
            ->getMock();

        $em
            ->expects($this->once())
            ->method('flush');

        $em
            ->expects($this->once())
            ->method('remove');

        return $em;
    }
}
