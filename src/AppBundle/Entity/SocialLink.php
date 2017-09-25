<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity
 */
class SocialLink
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    private $faIcon;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    private $url;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    private $title;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFaIcon(): ?string
    {
        return $this->faIcon;
    }

    public function setFaIcon(string $faIcon): SocialLink
    {
        $this->faIcon = $faIcon;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): SocialLink
    {
        $this->url = $url;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): SocialLink
    {
        $this->title = $title;

        return $this;
    }
}