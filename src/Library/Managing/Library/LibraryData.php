<?php

namespace App\Library\Managing\Library;

use App\Library\ArticleRepository;
use App\Library\Library;
use App\Library\LibraryRepository;

class LibraryData
{
    public function __construct(
        string $id,
        string $name = null,
        string $description = null,
        string $parentId = null,
        iterable $childIds = null,
        iterable $articleIds = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->parentId = $parentId;

        $this->childIds = is_null($childIds)
            ? null
            : (function (string ...$childIds): array {
                return $childIds;
            })(...$childIds);

        $this->articleIds = is_null($articleIds)
            ? null
            : (function (string ...$articleIds): array {
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

    public function updateLibrary(
        Library $library,
        LibraryRepository $libraryRepo,
        ArticleRepository $articleRepo
    ): void {
        $newName = $this->getName();
        if (!is_null($newName)) {
            $library->rename($newName);
        }

        $newDescription = $this->getDescription();
        if (!is_null($newDescription)) {
            $library->changeDescription($newDescription);
        }

        $newParentId = $this->getParentId();
        if (!is_null($newParentId)) {
            $newParent = $libraryRepo->get($newParentId);
            $library->changeParent($newParent);
        }

        $newArticleIds = $this->getArticleIds();
        if (!is_null($newArticleIds)) {
            $newArticles = $articleRepo->getAllByIds($newArticleIds);
            $library->updateArticles($newArticles);
        }

        $newChildIds = $this->getChildIds();
        if (!is_null($newChildIds)) {
            $newChildren = $libraryRepo->getAllByIds($newChildIds);
            $library->updateChildren($newChildren);
        }
    }

    private $id;
    private $name;
    private $description;
    private $parentId;
    private $childIds;
    private $articleIds;
}
