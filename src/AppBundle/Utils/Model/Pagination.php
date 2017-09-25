<?php

namespace AppBundle\Utils\Model;


class Pagination
{
    /** @var int */
    private $currentPage;

    /** @var int[] */
    private $pages;

    public function __construct(int $pagesCount, int $currentPage)
    {
        $pages = [];
        for ($i = 1; $i <= $pagesCount; $i ++) {
            $pages[] = $i;
        }

        $this->pages = $pages;
        $this->currentPage = $currentPage;
    }

    public function getCurrentPage() : ?int
    {
        return $this->currentPage;
    }

    public function setCurrentPage(int $page) : Pagination
    {
        $this->currentPage = $page;

        return $this;
    }

    // TODO: refactor
    public function getNextPage() : ?int
    {
        foreach ($this->pages as $page) {
            if ($page == ($this->currentPage + 1)) {
                return $page;
            }
        }

        return null;
    }

    // TODO: refactor
    public function getPrevPage() : ?int
    {
        foreach ($this->pages as $page) {
            if ($page == ($this->currentPage - 1)) {
                return $page;
            }
        }

        return null;
    }

    public function getPagesCount() : int
    {
        return count($this->pages);
    }

    public function getPages() : ?array
    {
        $pages = $this->pages;
        sort($pages);

        return $pages;
    }
}