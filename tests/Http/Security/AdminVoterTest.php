<?php


namespace App\Tests\Http\Security;


use App\Http\Security\AdminVoter;
use App\Http\Security\JWTIdentity;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class AdminVoterTest extends TestCase
{
    public function testVoteGranted()
    {
        $token = $this->createMock(TokenInterface::class);
        $token
            ->method('getUser')
            ->willReturn(new JWTIdentity('login', 'password'));

        $voter = new AdminVoter();

        $vote = $voter->vote($token, null, [AdminVoter::ADMIN_ACCESS]);

        $this->assertEquals(Voter::ACCESS_GRANTED, $vote);
    }

    public function testVoteAbstain()
    {
        $token = $this->createMock(TokenInterface::class);

        $voter = new AdminVoter();

        $vote = $voter->vote($token, null, ['any']);

        $this->assertEquals(Voter::ACCESS_ABSTAIN, $vote);
    }

    public function testVoteDenied()
    {
        $token = $this->createMock(TokenInterface::class);
        $token
            ->method('getUser')
            ->willReturn('some illegal shit');

        $voter = new AdminVoter();

        $vote = $voter->vote($token, null, [AdminVoter::ADMIN_ACCESS]);

        $this->assertEquals(Voter::ACCESS_DENIED, $vote);
    }
}