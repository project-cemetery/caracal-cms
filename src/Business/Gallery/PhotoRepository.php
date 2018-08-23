<?php

namespace App\Business\Gallery;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityNotFoundException;

class PhotoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Photo::class);
    }

    public function get(string $id): Photo
    {
        /** @var Photo|null $photo */
        $photo = $this->find($id);

        if (!$photo) {
            throw new EntityNotFoundException(sprintf('Photo with id "%s" not found', $id));
        }

        return $photo;
    }

    public function getAllByIds(array $ids): iterable
    {
        $ids = (function (string ...$ids): array {
            return $ids;
        })(...$ids);

        $photos = $this->findBy(['id' => $ids]);

        if (count($photos) !== count($ids)) {
            throw new EntityNotFoundException('One or more photos from the list are not found');
        }

        return $photos;
    }
}
