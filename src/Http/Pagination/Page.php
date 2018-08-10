<?php

namespace App\Http\Pagination;

class Page
{
    public function __construct(iterable $items, Pagination $pagination)
    {
        $this->items = $items;
        $this->pagination = $pagination;
    }

    public function getItems(): iterable
    {
        return $this->items;
    }

    public function getPagination(): Pagination
    {
        return $this->pagination;
    }

    private $items;

    private $pagination;
}
