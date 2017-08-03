<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 */
class Ticket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     * @var \DateTime
     */
    private $createdAt = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    private $customerName;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    private $customerEmail;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    private $customerMessage;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    private $answered = false;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Ticket
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * @param string $customerName
     * @return Ticket
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerEmail()
    {
        return $this->customerEmail;
    }

    /**
     * @param string $customerEmail
     * @return Ticket
     */
    public function setCustomerEmail($customerEmail)
    {
        $this->customerEmail = $customerEmail;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerMessage()
    {
        return $this->customerMessage;
    }

    /**
     * @param string $customerMessage
     * @return Ticket
     */
    public function setCustomerMessage($customerMessage)
    {
        $this->customerMessage = $customerMessage;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAnswered()
    {
        return $this->answered;
    }

    /**
     * @param bool $answered
     * @return Ticket
     */
    public function setAnswered($answered)
    {
        $this->answered = $answered;

        return $this;
    }
}