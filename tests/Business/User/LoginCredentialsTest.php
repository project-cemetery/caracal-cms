<?php


namespace App\Tests\Business\User;


use App\Business\User\LoginCredentials;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class LoginCredentialsTest extends TestCase
{
    public function testCreateEmpty()
    {
        $cred = LoginCredentials::createEmpty();

        $this->assertNull($cred->getPassword());
        $this->assertNull($cred->getLogin());
    }

    public function testCreate()
    {
        $encoder = $this->createMockPasswordEncoder();

        $cred = LoginCredentials::create('login', 'password', $encoder);

        $this->assertEquals('login', $cred->getLogin());
        $this->assertEquals('encoded password', $cred->getPassword());
    }

    public function testChangeLogin()
    {
        $encoder = $this->createMockPasswordEncoder();

        $cred = LoginCredentials::create('old login', 'password', $encoder);

        $cred->changeLogin('new login');

        $this->assertEquals('new login', $cred->getLogin());
    }

    public function testChangePassword()
    {
        $encoder = $this->createMockPasswordEncoder();

        $cred = LoginCredentials::create('old login', 'old password', $encoder);

        $cred->changePassword('new password', $encoder);

        $this->assertEquals('encoded new password', $cred->getPassword());
    }

    private function createMockPasswordEncoder()
    {
        $encoder = $this->createMock(PasswordEncoderInterface::class);

        $encoder
            ->method('encodePassword')
            ->will($this->returnCallback(function ($password) {
                return 'encoded ' . $password;
            }));

        return $encoder;
    }
}