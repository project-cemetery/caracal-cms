<?php

namespace AppBundle\DBAL;

use AppBundle\Entity\Contact;


class EnumContactType extends EnumType
{
    protected $name = 'enumcontacttype';
    protected $values = self::VALUES;

    const VALUES = [
        Contact::PHONE_TYPE,
        Contact::EMAIL_TYPE,
        Contact::ADDRESS_TYPE,
        Contact::VK_TYPE,
    ];
}