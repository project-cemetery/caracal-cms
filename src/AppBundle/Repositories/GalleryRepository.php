<?php

namespace AppBundle\Repositories;

use AppBundle\Entity\Gallery;
use Doctrine\ORM\EntityRepository;


class GalleryRepository extends EntityRepository
{
    const DEFAULT_GENERAL_LIMIT = 50;

    const ENTITY_ALIAS = 'entity';

    public function findGeneral($limit = self::DEFAULT_GENERAL_LIMIT)
    {
        /** @var Gallery[] $galleries */
        $galleries = $this
            ->createQueryBuilder(self::ENTITY_ALIAS)
            ->where(self::ENTITY_ALIAS . '.general = :general')
            ->setParameter('general', true)
            ->getQuery()
            ->setMaxResults($limit)
            ->getResult();

        $result = [];
        foreach ($galleries as $gallery) {
            $result = array_merge($result, $gallery->getImages()->toArray());
        }

        return $result;
    }
}