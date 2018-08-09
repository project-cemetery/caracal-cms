<?php

namespace App\Http\Pagination;

use Doctrine\ORM\EntityManagerInterface;

class Paginator
{
    /** @var EntityManagerInterface $em */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function find(string $className, Pagination $pagination): array
    {
        $page = $pagination->getPage();
        $perPage = $pagination->getPerPage();

        $offset = ($page - 1) * $perPage;

        return $this->em->createQueryBuilder()
            ->select('g')
            ->from($className, 'g')
            ->setFirstResult($offset)
            ->setMaxResults($perPage)
            ->getQuery()
            ->getResult();
    }

    public function getCount(string $className): int
    {
        return (int) $this->em->createQueryBuilder()
            ->select('count(g)')
            ->from($className, 'g')
            ->getQuery()
            ->getSingleScalarResult();
    }
}