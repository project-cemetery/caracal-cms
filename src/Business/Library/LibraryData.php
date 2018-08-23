<?php

namespace App\Business\Library;

class LibraryData
{
    public function __construct(
        string $id,
        string $name = null,
        string $description = null,
        string $parentId = null,
        iterable $articleIds = null,
        iterable $childIds = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->parentId = $parentId;

        $this->articleIds = is_null($articleIds)
            ? null
            : (function (string ...$articleIds): array {
                return $articleIds;
            })(...$articleIds);

        $this->childIds = is_null($childIds)
            ? null
            : (function (string ...$childIds): array {
                return $childIds;
            })(...$childIds);
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

    public function getArticleIds(): ?array
    {
        return $this->articleIds;
    }

    public function getChildIds(): ?array
    {
        return $this->childIds;
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

    /** @var string */
    private $id;
    /** @var string|null */
    private $name;
    /** @var string|null */
    private $description;
    /** @var string|null */
    private $parentId;
    /** @var array|null */
    private $articleIds;
    /** @var array|null */
    private $childIds;
}
