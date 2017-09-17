<?php

namespace AppBundle\Repositories;

use Doctrine\ORM\EntityRepository;


class ArticleRepository extends AbstartCustomRepository
{
    public function findLast($limit = self::DEFAULT_LAST_LIMIT)
    {
        $articles = $this->findLastByField($limit, 'createdAt');

        return $articles;
    }
}