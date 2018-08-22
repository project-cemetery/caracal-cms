<?php

namespace App\Tests\Gallery;

use App\Business\Gallery\Gallery;
use App\Business\Gallery\Photo;
use PHPUnit\Framework\TestCase;

class PhotoTest extends TestCase
{
    public function testCreateEmpty()
    {
        $photo = Photo::createEmpty('10', 'my fav link');

        $this->assertGreaterThan(1, mb_strlen($photo->getId()));
        $this->assertEquals('my fav link', $photo->toLink());
        $this->assertNull($photo->getName());
        $this->assertNull($photo->getDescription());
        $this->assertNull($photo->getGallery());
    }

    public function testCreate()
    {
        $photo = Photo::create('10', 'link link', 'name name', 'description description');

        $this->assertGreaterThan(1, mb_strlen($photo->getId()));
        $this->assertEquals('link link', $photo->toLink());
        $this->assertEquals('name name', $photo->getName());
        $this->assertEquals('description description', $photo->getDescription());
        $this->assertNull($photo->getGallery());
    }

    public function testRename()
    {
        $photo = Photo::createEmpty('10', 'link link');

        $photo->rename('new name');

        $this->assertEquals('new name', $photo->getName());
    }

    public function testChangeDescription()
    {
        $photo = Photo::createEmpty('10', 'link link');

        $photo->changeDescription('new description');

        $this->assertEquals('new description', $photo->getDescription());
    }

    public function testChangeLink()
    {
        $photo = Photo::createEmpty('10', 'old link');

        $photo->changeLink('new link');

        $this->assertEquals('new link', $photo->toLink());
    }

    public function testMoveOrphanToGallery()
    {
        $photo = Photo::createEmpty('10', 'link link');

        $gallery = Gallery::createEmpty('343');

        $photo->moveToGallery($gallery);

        $this->assertEquals($gallery, $photo->getGallery());
        $this->assertCount(1, $gallery->getPhotos());
    }

    public function testMoveFromOneToAnotherGallery()
    {
        $photo = Photo::createEmpty('10', 'link link');

        $oldGallery = Gallery::createEmpty('343');
        $photo->moveToGallery($oldGallery);

        $newGallery = Gallery::createEmpty('343');

        $photo->moveToGallery($newGallery);

        $this->assertCount(0, $oldGallery->getPhotos());
        $this->assertEquals($newGallery, $photo->getGallery());
        $this->assertCount(1, $newGallery->getPhotos());
    }

    public function testRemoveFromGallery()
    {
        $photo = Photo::createEmpty('10', 'link link');

        $gallery = Gallery::createEmpty('343');
        $photo->moveToGallery($gallery);

        $photo->removeFromGallery();
        $this->assertNull($photo->getGallery());
        $this->assertCount(0, $gallery->getPhotos());
    }

    public function testRemoveWithoutGalleryFromGallery()
    {
        $photo = Photo::createEmpty('10', 'link link');

        $photo->removeFromGallery();
        $this->assertNull($photo->getGallery());
    }
}
