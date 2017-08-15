<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repositories\GalleryRepository")
 */
class Gallery
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
     * @ORM\Column(name="description", type="text", nullable=true)
     * @var string
     */
    private $description;

    /**
     * @ORM\Column(name="year", type="integer")
     * @var int
     */
    private $year;

    /**
     * @ORM\OneToMany(targetEntity="GalleryImage", mappedBy="gallery", cascade={"persist", "remove"}, orphanRemoval=true)
     * @var ArrayCollection
     */
    private $images;

    /**
     * @ORM\Column(name="general", type="boolean")
     * @var boolean
     */
    private $general = false;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Gallery
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * @return Gallery
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Gallery
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param int $year
     * @return Gallery
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @param GalleryImage $image
     * @return $this
     */
    public function addImage(GalleryImage $image)
    {
        $image->setGallery($this);
        $this->images->add($image);

        return $this;
    }

    /**
     * @param GalleryImage $image
     * @return $this
     */
    public function removeImage(GalleryImage $image)
    {
        $this->images->removeElement($image);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @return bool
     */
    public function isGeneral()
    {
        return $this->general;
    }

    /**
     * @param bool $general
     * @return Gallery
     */
    public function setGeneral($general)
    {
        $this->general = $general;

        return $this;
    }
}