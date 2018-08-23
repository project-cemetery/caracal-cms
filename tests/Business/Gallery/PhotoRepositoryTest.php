<?php

namespace App\Tests\Gallery;

use App\DataFixtures\PhotoFixture;
use App\Business\Gallery\Photo;
use App\Business\Gallery\PhotoRepository;
use App\Tests\BaseRepositoryTest;
use Doctrine\ORM\EntityNotFoundException;

class PhotoRepositoryTest extends BaseRepositoryTest
{
    public function __construct(...$args)
    {
        parent::__construct([
            PhotoFixture::class,
        ], ...$args);
    }

    public function testGet()
    {
        /** @var PhotoRepository $repo */
        $repo = $this->getRepository(Photo::class);

        $photo = $repo->get('1');
        $this->assertEquals(1, $photo->getId());
        $this->assertEquals('link1', $photo->toLink());

        $this->expectException(EntityNotFoundException::class);
        $empty = $repo->get('empty');
    }

    public function testGetAllByIds()
    {
        /** @var PhotoRepository $repo */
        $repo = $this->getRepository(Photo::class);

        $photos = $repo->getAllByIds(['1', '2']);
        $this->assertCount(2, $photos);
        $this->assertContainsOnlyInstancesOf(Photo::class, $photos);
        foreach ($photos as $photo) {
            $this->assertContains($photo->getId(), ['1', '2']);
            $this->assertContains($photo->toLink(), ['link1', 'link2']);
        }

        $this->expectException(EntityNotFoundException::class);
        $empty = $repo->getAllByIds(['100', '1', '2']);
    }
}
