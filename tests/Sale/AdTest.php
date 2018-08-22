<?php

namespace App\Tests\Sale;

use App\Sale\Ad;
use PHPUnit\Framework\TestCase;

class AdTest extends TestCase
{
    public function testCreateEmpty()
    {
        $ad = Ad::createEmpty('adId');

        $this->assertGreaterThan(1, mb_strlen($ad->getId()));
        $this->assertNull($ad->getName());
        $this->assertNull($ad->getBody());
        $this->assertNull($ad->getExpireAt());
        $this->assertFalse($ad->isPublished());
        $this->assertCount(0, $ad->getImages());
    }

    public function testCreateWithoutExpiration()
    {
        $ad = Ad::create('adId', 'name', 'body', ['image one']);

        $this->assertGreaterThan(1, mb_strlen($ad->getId()));
        $this->assertEquals('name', $ad->getName());
        $this->assertEquals('body', $ad->getBody());
        $this->assertNull($ad->getExpireAt());
        $this->assertFalse($ad->isPublished());
        $this->assertCount(1, $ad->getImages());
    }

    public function testCreateWitExpiration()
    {
        $ad = Ad::create('adId', 'name', 'body', ['image one'], new \DateTimeImmutable());

        $this->assertGreaterThan(1, mb_strlen($ad->getId()));
        $this->assertEquals('name', $ad->getName());
        $this->assertEquals('body', $ad->getBody());
        $this->assertNotNull($ad->getExpireAt());
        $this->assertFalse($ad->isPublished());
        $this->assertCount(1, $ad->getImages());
    }

    public function testCreateWithInvalidImages()
    {
        $this->expectException(\TypeError::class);
        $ad = Ad::create('adId', 'name', 'body', [new \DateTime(), 'link to second image', 'link to other image']);
    }

    public function testRename()
    {
        $ad = Ad::createEmpty('adId');

        $ad->rename('new name');

        $this->assertEquals('new name', $ad->getName());
    }

    public function testChangeBody()
    {
        $ad = Ad::createEmpty('adId');

        $ad->changeBody('new body');

        $this->assertEquals('new body', $ad->getBody());
    }

    public function testAddImageToEmpty()
    {
        $ad = Ad::createEmpty('adId');

        $ad->addImage('new cool image');

        $this->assertCount(1, $ad->getImages());
    }

    public function testAddExistImage()
    {
        $ad = Ad::create('adId', 'name', 'body', ['new cool image']);

        $ad->addImage('new cool image');

        $this->assertCount(1, $ad->getImages());
    }

    public function testRemoveImage()
    {
        $ad = Ad::create('adId', 'name', 'body', ['new cool image']);

        $ad->removeImage('new cool image');

        $this->assertCount(0, $ad->getImages());
    }

    public function testChangeExpireDate()
    {
        $ad = Ad::createEmpty('adId');

        $ad->changeExpireDate(new \DateTimeImmutable());

        $this->assertNotNull($ad->getExpireAt());
    }

    public function testEternalize()
    {
        $ad = Ad::create('adId', 'name', 'body', [], new \DateTimeImmutable());

        $ad->eternalize();

        $this->assertNull($ad->getExpireAt());
    }

    public function testPublish()
    {
        $ad = Ad::createEmpty('adId');

        $ad->publish();

        $this->assertTrue($ad->isPublished());
    }

    public function testUnpublish()
    {
        $ad = Ad::createEmpty('adId');

        $ad->publish();

        $ad->unpublish();

        $this->assertFalse($ad->isPublished());
    }
}
