<?php

namespace App\Tests\Http\Security;

use App\Business\User\User;
use App\Business\User\UserRepository;
use App\Http\Security\JWTIdentity;
use App\Http\Security\JWTIdentityProvider;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class JWTIdentityProviderTest extends TestCase
{
    public function testLoadUserByUsername()
    {
        $provider = new JWTIdentityProvider(
            $this->createUserRepoMock()
        );

        $identity = $provider->loadUserByUsername('login');

        $this->assertEquals('login', $identity->getUsername());
        $this->assertEquals('encoded password', $identity->getPassword());
        $this->assertNull($identity->getSalt());
        $this->assertCount(0, $identity->getRoles());
    }

    public function testRefreshUser()
    {
        $identity = new JWTIdentity('login', 'encoded password');

        $provider = new JWTIdentityProvider(
            $this->createUserRepoMock()
        );

        $newIdentity = $provider->refreshUser($identity);

        $this->assertEquals($identity->getPassword(), $newIdentity->getPassword());
        $this->assertEquals($identity->getUsername(), $newIdentity->getUsername());
        $this->assertEquals($identity->getSalt(), $newIdentity->getSalt());
        $this->assertEquals($identity->getRoles(), $newIdentity->getRoles());
    }

    public function testSupportsClass()
    {
        $provider = new JWTIdentityProvider(
            $this->createUserRepoMock()
        );

        $this->assertTrue($provider->supportsClass(JWTIdentity::class));
        $this->assertFalse($provider->supportsClass('any other class'));
    }

    private function createUserRepoMock()
    {
        $encoder = $this->createMock(PasswordEncoderInterface::class);

        $encoder
            ->method('encodePassword')
            ->will($this->returnCallback(function ($password) {
                return 'encoded ' . $password;
            }));

        $repo = $this->createMock(UserRepository::class);

        $repo
            ->method('getByLogin')
            ->willReturn(User::createFromLogin('one', 'login', 'password', $encoder));

        return $repo;
    }
}
