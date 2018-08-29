<?php

namespace App\DataFixtures;

use App\Business\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

/** @psalm-suppress PropertyNotSetInConstructor */
class UserFixture extends Fixture
{
    /** @var PasswordEncoderInterface */
    private $passwordEncoder;

    public function __construct(PasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        $firstUser = User::createFromLogin('one', 'first', 'password', $this->passwordEncoder);
        $secondUser = User::createFromLogin('two', 'second', 'strong_psswd', $this->passwordEncoder);

        $manager->persist($firstUser);
        $manager->persist($secondUser);

        $manager->flush();
    }
}
