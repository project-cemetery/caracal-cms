<?php


namespace App\Tests\Gallery;


use App\DataFixtures\GalleryFixture;
use App\Gallery\Gallery;
use App\Gallery\GalleryRepository;
use App\Tests\BaseRepositoryTest;
use Doctrine\ORM\EntityNotFoundException;

class GalleryRepositoryTest extends BaseRepositoryTest
{
    public function __construct(...$args)
    {
        parent::__construct([
            GalleryFixture::class,
        ], ...$args);
    }

    public function testGet()
    {
        /** @var GalleryRepository $repo */
        $repo = $this->getRepository(Gallery::class);

        $gallery = $repo->get('1');
        $this->assertEquals(1, $gallery->getId());
        $this->assertNull($gallery->getName());

        $this->expectException(EntityNotFoundException::class);
        $empty = $repo->get('null');
    }
}