<?php

namespace AppBundle\Repositories;

use Doctrine\ORM\EntityRepository;


abstract class AbstractCustomRepository extends EntityRepository
{
    const DEFAULT_LAST_LIMIT = 2;

    const ENTITY_ALIAS = 'entity';

    protected function findLastByField($limit = self::DEFAULT_LAST_LIMIT, $field = 'id')
    {
        $entities = $this
            ->createQueryBuilder(self::ENTITY_ALIAS)
            ->orderBy(self::ENTITY_ALIAS . '.' . $field, 'DESC')
            ->getQuery()
            ->setMaxResults($limit)
            ->getResult();

        return $entities;
    }
}