<?php

namespace App\Library;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityNotFoundException;

class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function get(string $id): Article
    {
        /** @var Article|null $article */
        $article = $this->find($id);

        if (!$article) {
            throw new EntityNotFoundException(sprintf('Article with id "%s" not found', $id));
        }

        return $article;
    }
}
