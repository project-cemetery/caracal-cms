<?php

namespace App\Tests\Gallery\Managing\Gallery;

use App\Business\Gallery\Gallery;
use App\Business\Gallery\Managing\Gallery\GalleryData;
use App\Business\Gallery\Photo;
use App\Business\Gallery\PhotoRepository;
use PHPUnit\Framework\TestCase;

class GalleryDataTest extends TestCase
{
    public function testGetId()
    {
        $galleryData = new GalleryData('1');

        $this->assertEquals('1', $galleryData->getId());
    }

    public function testUpdateGalleryWithoutData()
    {
        $galleryData = new GalleryData('1');

        $gallery = Gallery::create('1', 'old name', 'old description');

        $galleryData->updateGallery(
            $gallery,
            $this->createMock(PhotoRepository::class)
        );

        $this->assertEquals('old name', $gallery->getName());
        $this->assertEquals('old description', $gallery->getDescription());
        $this->assertCount(0, $gallery->getPhotos());
    }

    public function testUpdateGalleryWithPrimitiveData()
    {
        $galleryData = new GalleryData('1', 'new name', 'new description');

        $gallery = Gallery::create('1', 'old name', 'old description');

        $galleryData->updateGallery(
            $gallery,
            $this->createMock(PhotoRepository::class)
        );

        $this->assertEquals('new name', $gallery->getName());
        $this->assertEquals('new description', $gallery->getDescription());
        $this->assertCount(0, $gallery->getPhotos());
    }

    public function testUpdateGalleryWithAllData()
    {
        $galleryData = new GalleryData('1', 'new name', 'new description', ['1', '2']);

        $gallery = Gallery::createEmpty('1');
        $gallery->updatePhotos([
            Photo::createEmpty('100', 'link100'),
        ]);

        $newPhotos = [
            Photo::createEmpty('1', 'link1'),
            Photo::createEmpty('2', 'link2'),
        ];

        $photoRepo = $this->createMock(PhotoRepository::class);
        $photoRepo
            ->method('getAllByIds')
            ->willReturn($newPhotos);

        $galleryData->updateGallery(
            $gallery,
            $photoRepo
        );

        $this->assertCount(2, $gallery->getPhotos());
        foreach ($gallery->getPhotos() as $galleryPhoto) {
            $this->assertContains($galleryPhoto->getId(), ['1', '2']);
            $this->assertContains($galleryPhoto->toLink(), ['link1', 'link2']);
        }
    }
}
