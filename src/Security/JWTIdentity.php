<?php


namespace App\Security;



use App\Business\User\User;
use Symfony\Component\Security\Core\User\UserInterface;

class JWTIdentity implements UserInterface
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getRoles(): array
    {
        return [];
    }

    public function getPassword(): string
    {
        return $this->user->getLoginCredentials()->getPassword();
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function getUsername(): string
    {
        return $this->user->getLoginCredentials()->getLogin();
    }

    public function eraseCredentials(): void
    {
    }

    public function getUser(): User
    {
        return $this->user;
    }

    private $user;
}