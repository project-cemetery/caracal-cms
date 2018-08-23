<?php


namespace App\Tests\Business\Gallery;


use App\Business\Gallery\Gallery;
use App\Business\Gallery\GalleryRepository;
use App\Business\Gallery\Photo;
use App\Business\Gallery\PhotoData;
use PHPUnit\Framework\TestCase;

class PhotoDataTest extends TestCase
{
    public function testGetId()
    {
        $data = new PhotoData('1');

        $this->assertEquals('1', $data->getId());
    }

    public function testUpdatePhotoWithoutData()
    {
        $data = new PhotoData('1');

        $photo = Photo::createEmpty('1', 'link');

        $data->updatePhoto(
            $photo,
            $this->createMock(GalleryRepository::class)
        );

        $this->assertEquals('1', $photo->getId());
        $this->assertEquals('link', $photo->toLink());
        $this->assertNull($photo->getName());
        $this->assertNull($photo->getDescription());
        $this->assertNull($photo->getGallery());
    }

    public function testUpdatePhotoWithPrimitiveData()
    {
        $data = new PhotoData('1', 'new name', 'new description', 'new link');

        $photo = Photo::createEmpty('1', 'old link');

        $data->updatePhoto(
            $photo,
            $this->createMock(GalleryRepository::class)
        );

        $this->assertEquals('1', $photo->getId());
        $this->assertEquals('new name', $photo->getName());
        $this->assertEquals('new description', $photo->getDescription());
        $this->assertEquals('new link', $photo->toLink());
        $this->assertNull($photo->getGallery());
    }

    public function testUpdateWithAllData()
    {
        $data = new PhotoData('1', 'name', 'description', 'link', 'galleryIdOne');

        $photo = Photo::createEmpty('1', 'link');

        $targetGallery = Gallery::createEmpty('galleryIdOne');

        $galleryRepo = $this->createMock(GalleryRepository::class);
        $galleryRepo
            ->method('get')
            ->willReturn($targetGallery);

        $data->updatePhoto(
            $photo,
            $galleryRepo
        );

        $this->assertNotNull($photo->getGallery());
        $this->assertEquals('galleryIdOne', $photo->getGallery()->getId());
        $this->assertCount(1, $targetGallery->getPhotos());
    }
}