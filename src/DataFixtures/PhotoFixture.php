<?php

namespace App\DataFixtures;

use App\Gallery\Photo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PhotoFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; ++$i) {
            $photo = Photo::createEmpty((string) $i, 'link' . $i);
            $manager->persist($photo);
        }

        $manager->flush();
    }
}
