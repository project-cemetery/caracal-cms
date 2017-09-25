<?php

namespace AppBundle\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;


abstract class AbstractCustomRepository extends EntityRepository
{
    const DEFAULT_LAST_LIMIT = 2;
    const DEFAULT_ENTITIES_PER_PAGE = 6;

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

    public function findFilteredByPage(
        array $filters,
        int $page = 1,
        int $entitiesPerPage = self::DEFAULT_ENTITIES_PER_PAGE
    ): array {
        return $this
            ->findFiltered(
                $filters,
                ($page - 1) * $entitiesPerPage,
                $entitiesPerPage
            );
    }

    public function findFiltered(
        array $query,
        int $offset = 0,
        int $entitiesPerPage = self::DEFAULT_ENTITIES_PER_PAGE
    ): array {
        return $this->getFilterQueryBuilder($query)
            ->setFirstResult($offset)
            ->setMaxResults($entitiesPerPage)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $query
     * @return mixed
     */
    public function getFilteredCount(array $query) {
        return $this
            ->getFilterQueryBuilder($query)->select('count(' . self::ENTITY_ALIAS . ')')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @param $query array
     * @return QueryBuilder
     */
    abstract protected function getFilterQueryBuilder(array $query);
}