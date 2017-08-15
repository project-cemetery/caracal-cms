<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 */
class BottomLink
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string")
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(name="link", type="string")
     * @var string
     */
    private $link;

    /**
     * @ORM\Column(name="priority", type="integer")
     * @var int
     */
    private $priority;

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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return BottomLink
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     * @return BottomLink
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     * @return BottomLink
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }
}