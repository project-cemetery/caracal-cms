<?php

namespace AppBundle\Repositories;

use AppBundle\Entity\Article;
use Doctrine\ORM\EntityRepository;


class ArticleRepository extends AbstractCustomRepository
{
    public function findLast($limit = self::DEFAULT_LAST_LIMIT)
    {
        return $this->findLastByField($limit, 'createdAt');
    }

    public function findOneHero()
    {
        return $this->findOneBy(['hero' => true]);
    }

    public function getFilterQueryBuilder(array $query)
    {
        $qb = $this->createQueryBuilder(self::ENTITY_ALIAS);

        if (!empty($query['enabled'])) {
            $qb->andWhere(self::ENTITY_ALIAS . '.enabled = :enabled')
                ->setParameter('enabled', $query['enabled']);
        }

        if (!empty($query['category'])) {
            $qb->andWhere(self::ENTITY_ALIAS . '.category = :category')
                ->setParameter('category', $query['category']);
        }

        $qb->orderBy(self::ENTITY_ALIAS . '.createdAt', 'DESC');

        return $qb;
    }
}