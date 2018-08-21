<?php


namespace App\Tests\Gallery\Managing\Gallery;


use App\Gallery\Managing\Gallery\GalleryCreateCommand;
use App\Gallery\Managing\Gallery\GalleryCreateHandler;
use App\Gallery\Managing\Gallery\GalleryData;
use App\Gallery\PhotoRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class GalleryCreateHandlerTest extends TestCase
{
    public function testInvoke()
    {
        $command = $this->createCommandMock();

        $handler = new GalleryCreateHandler(
            $this->createEmMock(),
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

        $command = $this->createMock(GalleryCreateCommand::class);
        $command
            ->method('getData')
            ->willReturn($data);

        return $command;
    }

    private function createEmMock()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->setMethods(['persist', 'flush'])
            ->disableOriginalConstructor()
            ->getMock();

        $em
            ->expects($this->once())
            ->method('flush');

        $em
            ->expects($this->once())
            ->method('persist');

        return $em;
    }
}