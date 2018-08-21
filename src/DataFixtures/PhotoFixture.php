<?php


namespace App\DataFixtures;


use App\Gallery\Gallery;
use App\Gallery\Photo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PhotoFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $photo = Photo::createEmpty($i, 'link' . $i);
            $manager->persist($photo);
        }

        $manager->flush();
    }
}