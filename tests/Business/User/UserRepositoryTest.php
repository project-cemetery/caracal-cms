<?php


namespace App\Tests\Business\User;


use App\Business\User\User;
use App\Business\User\UserRepository;
use App\DataFixtures\UserFixture;
use App\Tests\BaseRepositoryTest;
use Doctrine\ORM\EntityNotFoundException;

class UserRepositoryTest extends BaseRepositoryTest
{
    public function __construct(...$args)
    {
        parent::__construct([
            UserFixture::class,
        ], ...$args);
    }

    public function testGetByLogin()
    {
        /** @var UserRepository $repo */
        $repo = $this->getRepository(User::class);

        $realUser = $repo->getByLogin('first');
        $this->assertEquals('one', $realUser->getId());

        $this->expectException(EntityNotFoundException::class);
        $nullUser = $repo->getByLogin('not_exist_login');
    }
}