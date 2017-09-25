<?php

namespace AppBundle\Repositories;

use Doctrine\ORM\EntityRepository;


class AdvertRepository extends AbstractCustomRepository
{
    public function findLast($limit = self::DEFAULT_LAST_LIMIT)
    {
        $adverts = $this->findLastByField($limit, 'createdAt');

        return $adverts;
    }
}