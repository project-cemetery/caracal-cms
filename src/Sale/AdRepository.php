<?php

namespace App\Sale;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityNotFoundException;

class AdRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ad::class);
    }

    public function get(string $id): Ad
    {
        /** @var Ad|null $ad */
        $ad = $this->find($id);

        if (!$ad) {
            throw new EntityNotFoundException(sprintf('Ad with id "%s" not found', $id));
        }

        return $ad;
    }
}
