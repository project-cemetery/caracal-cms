<?php

namespace App\Business\Library\Managing\Article;

use App\Command\CreateCommand;

class ArticleCreateCommand implements CreateCommand
{
    public function __construct(
        string $id,
        string $name = null,
        string $description = null,
        string $body = null,
        string $libraryId = null
    ) {
        $this->data = new ArticleData($id, $name, $description, $body, $libraryId);
    }

    public function getData(): ArticleData
    {
        return $this->data;
    }

    /** @var ArticleData */
    private $data;
}
