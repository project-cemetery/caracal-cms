<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 */
class Contact
{
    const PHONE_TYPE = 'Phone';
    const EMAIL_TYPE = 'Email';
    const ADDRESS_TYPE = 'Address';
    const VK_TYPE = 'VK';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="type", type="enumcontacttype", unique=true)
     * @var string
     */
    private $type;

    /**
     * @ORM\Column(name="body", type="text")
     * @var string
     */
    private $body;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Contact
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return Contact
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->type;
    }
}