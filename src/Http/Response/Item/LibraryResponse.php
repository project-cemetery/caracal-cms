<?php

namespace App\Http\Response\Item;

use App\Library\Article;
use App\Library\Library;

class LibraryResponse implements ItemResponse
{
    public static function fromEntity(Library $library): self
    {
        $children = array_map(
            function (Library $library): LibraryResponse {
                return self::fromEntity($library);
            },
            $library->getChildren()
        );

        $articles = array_map(
            function (Article $article): ArticleResponse {
                return ArticleResponse::fromEntity($article);
            },
            $library->getArticles() ?? []
        );

        return new self(
            $library->getId(),
            $library->getName() ?? '',
            $library->getDescription() ?? '',
            $children,
            $articles
        );
    }

    public function __construct(
        string $id,
        string $name,
        string $description,
        iterable $children,
        iterable $articles
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;

        $this->children = (function (LibraryResponse ...$children): array {
            return $children;
        })(...$children);

        $this->articles = (function (ArticleResponse ...$articles): array {
            return $articles;
        })(...$articles);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    public function getArticles(): array
    {
        return $this->articles;
    }

    /** @var string */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $description;
    /** @var self[] */
    private $children;
    /** @var ArticleResponse[] */
    private $articles;
}
