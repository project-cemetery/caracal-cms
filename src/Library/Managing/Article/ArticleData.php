<?php


namespace App\Library\Managing\Article;


use App\Library\Article;
use App\Library\LibraryRepository;

class ArticleData
{
    public function __construct(
        string $id,
        string $name = null,
        string $body = null,
        string $description =  null,
        string $libraryId = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->body = $body;
        $this->description = $description;
        $this->libraryId = $libraryId;
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

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function getLibraryId(): ?string
    {
        return $this->libraryId;
    }

    public function updateArticle(Article $article, LibraryRepository $libraryRepo): void
    {
        // TODO: update
    }

    /** @var string */
    private $id;
    /** @var string|null */
    private $name;
    /** @var string|null */
    private $body;
    /** @var string|null */
    private $description;
    /** @var string|null */
    private $libraryId;
}