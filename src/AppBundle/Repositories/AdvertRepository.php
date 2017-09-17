<?php

namespace AppBundle\Repositories;

use Doctrine\ORM\EntityRepository;


class AdvertRepository extends EntityRepository
{
    const DEFAULT_LAST_LIMIT = 2;

    const ENTITY_ALIAS = 'entity';

    public function findLast($limit = self::DEFAULT_LAST_LIMIT)
    {
        $adverts = $this
            ->createQueryBuilder(self::ENTITY_ALIAS)
            ->orderBy(self::ENTITY_ALIAS . '.createdAt', 'DESC')
            ->getQuery()
            ->setMaxResults($limit)
            ->getResult();

        return $adverts;
    }
}