<?php

namespace App\Http\Security;

use App\Business\User\LoginCredentials;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

class JWTIdentity implements UserInterface
{
    public static function fromLoginCredentials(LoginCredentials $credentials): self
    {
        $login = $credentials->getLogin();
        if (!$login) {
            throw new AccessDeniedException('Empty login');
        }

        $password = $credentials->getPassword();
        if (!$password) {
            throw new AccessDeniedException('Empty password');
        }

        return new self($login, $password);
    }

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function getRoles()
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

    /** @var string */
    private $username;
    /** @var string */
    private $password;
}
