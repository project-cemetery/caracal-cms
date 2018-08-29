<?php

namespace App\Business\User;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function getByLogin(string $login): User
    {
        /** @var User|null $user */
        $user = $this->findOneBy([
            'loginCredentials.login' => $login,
        ]);

        if (!$user) {
            throw new EntityNotFoundException(sprintf('User with login "%s" not found', $login));
        }

        return $user;
    }
}
