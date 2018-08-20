<?php


namespace App\Library\Managing\Library;


class LibraryData
{
    public function __construct(
        string $id,
        string $name = null,
        string $description = null,
        string $parentId = null,
        iterable $childIds = [],
        iterable $articleIds = []
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->parentId = $parentId;

        $this->childIds = (function (string ...$childIds): array {
            return $childIds;
        })(...$childIds);

        $this->articleIds = (function (string ...$articleIds): array {
            return $articleIds;
        })(...$articleIds);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getParentId(): ?string
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

    private $id;
    private $name;
    private $description;
    private $parentId;
    private $childIds;
    private $articleIds;
}