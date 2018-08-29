<?php

namespace App\Http\Security;

use App\Business\User\User;
use Symfony\Component\Security\Core\User\UserInterface;

class JWTIdentity implements UserInterface
{
    public static function fromUser(User $user): self
    {
        return new self(
            $user->getLoginCredentials()->getLogin(),
            $user->getLoginCredentials()->getPassword()
        );
    }

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function getRoles(): array
    {
        return [];
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function eraseCredentials(): void
    {
    }

    private $username;
    private $password;
}
