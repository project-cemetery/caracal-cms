<?php

namespace App\Tests\Http\Security;

use App\Business\User\LoginCredentials;
use App\Http\Security\JWTIdentity;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class JWTIdentityTest extends TestCase
{
    public function testFromCorrectLoginCredentials()
    {
        $encoder = $this->createMock(PasswordEncoderInterface::class);
        $encoder
            ->method('encodePassword')
            ->willReturnArgument(0);

        $cred = LoginCredentials::create('login', 'password', $encoder);

        $identity = JWTIdentity::fromLoginCredentials($cred);

        $this->assertEquals('login', $identity->getUsername());
        $this->assertEquals('password', $identity->getPassword());
        $this->assertNull($identity->getSalt());
        $this->assertCount(0, $identity->getRoles());
    }

    public function testFromLoginCredentialsWithoutLogin()
    {
        $encoder = $this->createMock(PasswordEncoderInterface::class);
        $encoder
            ->method('encodePassword')
            ->willReturnArgument(0);

        $cred = LoginCredentials::createEmpty();
        $cred->changePassword('password', $encoder);

        $this->expectException(AccessDeniedException::class);
        $identity = JWTIdentity::fromLoginCredentials($cred);
    }

    public function testFromLoginCredentialsWithoutPassword()
    {
        $cred = LoginCredentials::createEmpty();
        $cred->changeLogin('login');

        $this->expectException(AccessDeniedException::class);
        $identity = JWTIdentity::fromLoginCredentials($cred);
    }

    public function testEraseCredentials()
    {
        $identity = new JWTIdentity('username', 'password');

        $identity->eraseCredentials();

        $this->assertEquals('username', $identity->getUsername());
        $this->assertEquals('password', $identity->getPassword());
        $this->assertNull($identity->getSalt());
        $this->assertCount(0, $identity->getRoles());
    }
}
