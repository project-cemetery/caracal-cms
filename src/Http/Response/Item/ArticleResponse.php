<?php

namespace App\Http\Response\Item;

use App\Library\Article;

class ArticleResponse implements ItemResponse
{
    public static function fromEntity(Article $article): self
    {
        return new self(
            $article->getId(),
            $article->getName() ?? '',
            $article->getDescription() ?? '',
            $article->getBody() ?? '',
            $article->getCreatedAt()
        );
    }

    public function __construct(
        string $id,
        string $name,
        string $description,
        string $body,
        \DateTimeImmutable $createdAt
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->body = $body;
        $this->createdAt = $createdAt;
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
}
