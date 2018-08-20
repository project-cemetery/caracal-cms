<?php

namespace App\Library;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityNotFoundException;

class LibraryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Library::class);
    }

    public function get(string $id): Library
    {
        /** @var Library|null $library */
        $library = $this->find($id);

        if (!$library) {
            throw new EntityNotFoundException(sprintf('Library with id "%s" not found', $id));
        }

        return $library;
    }
}
