<?php

namespace App\Tests\Gallery;

use App\Gallery\Gallery;
use App\Gallery\Photo;
use PHPUnit\Framework\TestCase;

class GalleryTest extends TestCase
{
    public function testCreateEmpty()
    {
        $gallery = Gallery::createEmpty();

        $this->assertGreaterThan(1, mb_strlen($gallery->getId()));
        $this->assertNull($gallery->getName());
        $this->assertNull($gallery->getDescription());
        $this->assertCount(0, $gallery->getPhotos());
    }

    public function testCreate()
    {
        $gallery = Gallery::create('name', 'description');

        $this->assertGreaterThan(1, mb_strlen($gallery->getId()));
        $this->assertEquals('name', $gallery->getName());
        $this->assertEquals('description', $gallery->getDescription());
        $this->assertCount(0, $gallery->getPhotos());
    }

    public function testRename()
    {
        $gallery = Gallery::createEmpty();

        $gallery->rename('new name');

        $this->assertEquals('new name', $gallery->getName());
    }

    public function testChangeDescription()
    {
        $gallery = Gallery::createEmpty();

        $gallery->changeDescription('new description');

        $this->assertEquals('new description', $gallery->getDescription());
    }

    public function testAddOrphanPhoto()
    {
        $gallery = Gallery::createEmpty();

        $photo = Photo::createEmpty('link link');

        $gallery->addPhoto($photo);

        $this->assertEquals($gallery, $photo->getGallery());
        $this->assertCount(1, $gallery->getPhotos());
    }

    public function testAddPhotoFromOtherGallery()
    {
        $newGallery = Gallery::createEmpty();

        $photo = Photo::createEmpty('link link');
        $oldGallery = Gallery::createEmpty();
        $oldGallery->addPhoto($photo);

        $newGallery->addPhoto($photo);

        $this->assertEquals($newGallery, $photo->getGallery());
        $this->assertCount(0, $oldGallery->getPhotos());
        $this->assertCount(1, $newGallery->getPhotos());
    }

    public function testRemovePhoto()
    {
        $gallery = Gallery::createEmpty();

        $photo = Photo::createEmpty('link link');
        $gallery->addPhoto($photo);

        $gallery->removePhoto($photo);

        $this->assertNull($photo->getGallery());
        $this->assertCount(0, $gallery->getPhotos());
    }
}
