<?php

namespace App\Tests\Business\User;

use App\Business\User\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class UserTest extends TestCase
{
    public function testCreateFromLogin()
    {
        $encoder = $this->createMock(PasswordEncoderInterface::class);
        $encoder
            ->method('encodePassword')
            ->willReturn('encoded!');

        $user = User::createFromLogin('idUser', 'loginOne', 'passwordOne', $encoder);

        $this->assertEquals('idUser', $user->getId());
        $this->assertEquals('loginOne', $user->getLoginCredentials()->getLogin());
        $this->assertEquals('encoded!', $user->getLoginCredentials()->getPassword());
    }
}
