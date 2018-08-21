<?php


namespace App\DataFixtures;


use App\Gallery\Gallery;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class GalleryFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $gallery = Gallery::createEmpty($i);
            $manager->persist($gallery);
        }

        $manager->flush();
    }
}