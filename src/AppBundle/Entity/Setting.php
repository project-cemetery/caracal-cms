<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 */
class Setting
{
    const COMPANY_NAME_TYPE = 'Company name';
    const COMPANY_TAGLINE_TYPE = 'Company tagline';

    const SEO_TITLE_TYPE = 'SEO title';
    const SEO_KEYWORDS_TYPE = 'SEO keywords';
    const SEO_DESCRIPTION_TYPE = 'SEO description';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="type", type="enumsettingtype", unique=true)
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
     * @return Setting
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
     * @return Setting
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