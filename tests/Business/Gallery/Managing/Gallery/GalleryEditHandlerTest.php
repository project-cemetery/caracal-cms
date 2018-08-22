<?php

namespace App\Tests\Gallery\Managing\Gallery;

use App\Business\Gallery\GalleryRepository;
use App\Business\Gallery\Managing\Gallery\GalleryData;
use App\Business\Gallery\Managing\Gallery\GalleryEditCommand;
use App\Business\Gallery\Managing\Gallery\GalleryEditHandler;
use App\Business\Gallery\PhotoRepository;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;

class GalleryEditHandlerTest extends TestCase
{
    public function testInvoke()
    {
        $command = $this->createCommandMock();

        $handler = new GalleryEditHandler(
            $this->createEmMock(),
            $this->createMock(GalleryRepository::class),
            $this->createMock(PhotoRepository::class)
        );

        $handler($command);
    }

    private function createCommandMock()
    {
        $data = $this->getMockBuilder(GalleryData::class)
            ->setMethods(['getId', 'updateGallery'])
            ->setConstructorArgs(['1'])
            ->getMock();

        $data
            ->expects($this->once())
            ->method('updateGallery');

        $command = $this->createMock(GalleryEditCommand::class);
        $command
            ->method('getData')
            ->willReturn($data);

        return $command;
    }

    private function createEmMock()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->setMethods(['flush'])
            ->disableOriginalConstructor()
            ->getMock();

        $em
            ->expects($this->once())
            ->method('flush');

        return $em;
    }
}
