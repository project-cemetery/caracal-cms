<?php

namespace App\Http\Response\Item;

use App\Business\Library\Article;

class ArticleResponse implements ItemResponse
{
    public static function fromEntity(Article $article): self
    {
        $library = $article->getLibrary();
        $libraryId = !is_null($library) ? $library->getId() : null;

        return new self(
            $article->getId(),
            $article->getName() ?? '',
            $article->getDescription() ?? '',
            $article->getBody() ?? '',
            $article->getCreatedAt(),
            $libraryId
        );
    }

    public function __construct(
        string $id,
        string $name,
        string $description,
        string $body,
        \DateTimeImmutable $createdAt,
        ?string $libraryId = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->body = $body;
        $this->createdAt = $createdAt;
        $this->libraryId = $libraryId;
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

    public function getBody(): string
    {
        return $this->body;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getLibraryId(): ?string
    {
        return $this->libraryId;
    }

    /** @var string */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $description;
    /** @var string */
    private $body;
    /** @var \DateTimeImmutable */
    private $createdAt;
    /** @var string|null */
    private $libraryId;
}
