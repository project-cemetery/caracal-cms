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

    public function getAllByIds(array $ids): iterable
    {
        $ids = (function (string ...$ids): array {
            return $ids;
        })(...$ids);

        $articles = $this->findBy(['id' => $ids]);

        if (count($articles) !== count($ids)) {
            throw new EntityNotFoundException('One or more article from the list are not found');
        }

        return $articles;
    }
}
