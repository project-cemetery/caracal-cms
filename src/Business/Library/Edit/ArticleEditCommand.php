<?php

namespace App\Business\Library\Edit;

use App\Business\Library\ArticleData;
use App\Command\EditCommand;

class ArticleEditCommand extends EditCommand
{
    public static function fromData(ArticleData $data): self
    {
        return new self($data);
    }

    public function getData(): ArticleData
    {
        return $this->data;
    }
}
