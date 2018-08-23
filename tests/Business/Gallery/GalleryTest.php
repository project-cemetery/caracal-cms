<?php

namespace App\Tests\Gallery;

use App\Business\Gallery\Gallery;
use App\Business\Gallery\Photo;
use PHPUnit\Framework\TestCase;

class GalleryTest extends TestCase
{
    public function testCreateEmpty()
    {
        $gallery = Gallery::createEmpty('343');

        $this->assertGreaterThan(1, mb_strlen($gallery->getId()));
        $this->assertNull($gallery->getName());
        $this->assertNull($gallery->getDescription());
        $this->assertCount(0, $gallery->getPhotos());
    }

    public function testCreate()
    {
        $gallery = Gallery::create('343', 'name', 'description');

        $this->assertGreaterThan(1, mb_strlen($gallery->getId()));
        $this->assertEquals('name', $gallery->getName());
        $this->assertEquals('description', $gallery->getDescription());
        $this->assertCount(0, $gallery->getPhotos());
    }

    public function testRename()
    {
        $gallery = Gallery::createEmpty('343');

        $gallery->rename('new name');

        $this->assertEquals('new name', $gallery->getName());
    }

    public function testChangeDescription()
    {
        $gallery = Gallery::createEmpty('343');

        $gallery->changeDescription('new description');

        $this->assertEquals('new description', $gallery->getDescription());
    }

    public function testAddOrphanPhoto()
    {
        $gallery = Gallery::createEmpty('343');

        $photo = Photo::createEmpty('10', 'link link');

        $gallery->addPhoto($photo);

        $this->assertEquals($gallery, $photo->getGallery());
        $this->assertCount(1, $gallery->getPhotos());
    }

    public function testAddPhotoFromOtherGallery()
    {
        $newGallery = Gallery::createEmpty('343');

        $photo = Photo::createEmpty('10', 'link link');
        $oldGallery = Gallery::createEmpty('343');
        $oldGallery->addPhoto($photo);

        $newGallery->addPhoto($photo);

        $this->assertEquals($newGallery, $photo->getGallery());
        $this->assertCount(0, $oldGallery->getPhotos());
        $this->assertCount(1, $newGallery->getPhotos());
    }

    public function testRemovePhoto()
    {
        $gallery = Gallery::createEmpty('343');

        $photo = Photo::createEmpty('10', 'link link');
        $gallery->addPhoto($photo);

        $gallery->removePhoto($photo);

        $this->assertNull($photo->getGallery());
        $this->assertCount(0, $gallery->getPhotos());
    }

    public function testUpdatePhotosToNew()
    {
        $gallery = Gallery::createEmpty('343');

        $oldPhotos = [
            Photo::createEmpty('1', 'one'),
            Photo::createEmpty('2', 'two'),
        ];

        foreach ($oldPhotos as $photo) {
            $gallery->addPhoto($photo);
        }

        $newPhotos = [
            Photo::createEmpty('3', 'three'),
        ];

        $gallery->updatePhotos($newPhotos);

        $this->assertCount(1, $gallery->getPhotos());

        $resultPhotos = $gallery->getPhotos();
        $this->assertEquals('3', array_shift($resultPhotos)->getId());
    }

    public function testUpdatePhotosToSame()
    {
        $gallery = Gallery::createEmpty('343');

        $oldPhotos = [
            Photo::createEmpty('1', 'one'),
            Photo::createEmpty('2', 'two'),
        ];

        foreach ($oldPhotos as $photo) {
            $gallery->addPhoto($photo);
        }

        $gallery->updatePhotos($oldPhotos);

        $this->assertCount(2, $gallery->getPhotos());

        $resultPhotos = $gallery->getPhotos();
        $this->assertEquals('1', array_shift($resultPhotos)->getId());
        $this->assertEquals('2', array_shift($resultPhotos)->getId());
    }

    public function testGetCreatedAt()
    {
        $gallery = Gallery::createEmpty('1');
        $now = new \DateTimeImmutable();

        $diff = $gallery->getCreatedAt()->getTimestamp() - $now->getTimestamp();
        $this->assertGreaterThanOrEqual(0, $diff);
        $this->assertLessThanOrEqual(1000, $diff);
    }
}
