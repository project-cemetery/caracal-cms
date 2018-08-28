<?php


namespace App\Business\User;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

/**
 * @ORM\Entity(repositoryClass="App\Business\User\UserRepository")
 */
class User
{
    // Constructors

    public static function createFromLogin(
        string $id,
        string $login,
        string $password,
        PasswordEncoderInterface $encoder
    ): self {
        $instance = new self();

        $instance->id = $id;
        $instance->loginCredentials = LoginCredentials::create($login, $password, $encoder);

        return $instance;
    }

    // Behaviour

    // Data

    public function getId(): string
    {
        return $this->id;
    }

    public function getLoginCredentials(): LoginCredentials
    {
        return $this->loginCredentials;
    }

    // Internal

    public function __construct()
    {
        $this->loginCredentials = new LoginCredentials();
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=32)
     */
    private $id;

    /** @ORM\Embedded(class = "LoginCredentials") */
    private $loginCredentials;
}