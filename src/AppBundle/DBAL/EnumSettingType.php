<?php

namespace AppBundle\DBAL;

use AppBundle\Entity\Setting;


class EnumSettingType extends EnumType
{
    protected $name = 'enumsettingtype';
    protected $values = [
        Setting::COMPANY_NAME_TYPE,
        Setting::COMPANY_TAGLINE_TYPE,
        Setting::SEO_TITLE_TYPE,
        Setting::SEO_KEYWORDS_TYPE,
        Setting::SEO_DESCRIPTION_TYPE,
    ];
}