<?php

namespace AppBundle\DBAL;

use AppBundle\Entity\TemplateImage;


class EnumTemplateImageType extends EnumType
{
    protected $name = 'enumtemplateimagetype';
    protected $values = [
        TemplateImage::LOGO_TYPE,
        TemplateImage::MAP_TYPE,
        TemplateImage::FAVICON_TYPE,
    ];
}