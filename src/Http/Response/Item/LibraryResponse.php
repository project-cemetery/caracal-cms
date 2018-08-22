<?php

namespace App\Http\Response\Item;

use App\Library\Article;
use App\Library\Library;

class LibraryResponse implements ItemResponse
{
    public static function fromEntity(Library $library): self
    {
        $childIds = array_map(
            function (Library $library): string {
                return $library->getId();
            },
            $library->getChildren()
        );

        $articleIds = array_map(
            function (Article $article): string {
                return $article ->getId();
            },
            $library->getArticles()
        );

        $parentId = $library->getParent()
            ? $library->getParent()->getId()
            : null;

        return new self(
            $library->getId(),
            $library->getName() ?? '',
            $library->getDescription() ?? '',
            $childIds,
            $articleIds,
            $parentId
        );
    }

    public function __construct(
        string $id,
        string $name,
        string $description,
        iterable $childIds,
        iterable $articleIds,
        ?string $parentId = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;

        $this->childIds = (function (string ...$children): array {
            return $children;
        })(...$childIds);

        $this->articleIds = (function (string ...$articles): array {
            return $articles;
        })(...$articleIds);

        $this->parentId = $parentId;
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

    public function getParent(): ?string
    {
        return $this->parentId;
    }

    public function getChildIds(): array
    {
        return $this->childIds;
    }

    public function getArticleIds(): array
    {
        return $this->articleIds;
    }

    /** @var string */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $description;
    /** @var string|null */
    private $parentId;
    /** @var string[] */
    private $childIds;
    /** @var string[] */
    private $articleIds;
}
