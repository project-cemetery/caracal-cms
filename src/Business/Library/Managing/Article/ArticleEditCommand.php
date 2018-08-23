<?php

namespace App\Business\Library\Managing\Article;

use App\Command\EditCommand;

class ArticleEditCommand implements EditCommand
{
    public static function fromData(ArticleData $data): self
    {
        $instance = new self();

        $instance->data = $data;

        return $instance;
    }

    public function getData(): ArticleData
    {
        return $this->data;
    }

    /** @var ArticleData */
    private $data;
}
