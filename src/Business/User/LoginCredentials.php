<?php

namespace App\Business\User;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

/** @ORM\Embeddable */
class LoginCredentials
{
    // Constructors

    public static function createEmpty(): self
    {
        $instance = new self();

        return $instance;
    }

    public static function create(string $login, string $password, PasswordEncoderInterface $encoder): self
    {
        $instance = self::createEmpty();

        $instance->login = $login;
        $instance->changePassword($password, $encoder);

        return $instance;
    }

    // Behaviour

    public function changeLogin(string $newLogin): void
    {
        $this->login = $newLogin;
    }

    public function changePassword(string $plainPassword, PasswordEncoderInterface $encoder): void
    {
        $this->password = $encoder->encodePassword($plainPassword, '');
    }

    // Data

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    // Internal

    /** @ORM\Column(type="string", length=127, unique=true, nullable=true) */
    private $login;

    /** @ORM\Column(type="string", length=127, nullable=true) */
    private $password;
}
