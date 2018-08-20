<?php

namespace App\Http\Pagination;

class Page
{
    public function __construct(iterable $items, Pagination $pagination, int $totalCount)
    {
        $this->items = $items;
        $this->pagination = $pagination;
        $this->totalCount = $totalCount;
    }

    public function getItems(): iterable
    {
        return $this->items;
    }

    public function getPagination(): Pagination
    {
        return $this->pagination;
    }

    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    /** @var iterable */
    private $items;

    /** @var Pagination */
    private $pagination;

    /** @var int */
    private $totalCount;
}
