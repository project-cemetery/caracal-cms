<?php


namespace App\Security;

use App\Business\User\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class JWTIdentityProvider implements UserProviderInterface
{
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function loadUserByUsername($username): UserInterface
    {
        $user = $this->userRepo->getByLogin($username);

        $jwtUser = new JWTIdentity($user);

        return $jwtUser;
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class): bool
    {
        return $class === JWTIdentity::class;
    }
}