<?php

namespace App\Tests\Http\Pagination;

use App\Http\Pagination\Page;
use App\Http\Pagination\Pagination;
use PHPUnit\Framework\TestCase;

class PageTest extends TestCase
{
    public function testGetItems()
    {
        $page = new Page([1, 2], new Pagination(1, 2), 10);

        $this->assertEquals([1, 2], $page->getItems());
    }

    public function testGetPagination()
    {
        $pagination = new Pagination(1, 2);

        $page = new Page([1, 2], $pagination, 10);

        $this->assertEquals($pagination, $page->getPagination());
    }

    public function testGetTotalCount()
    {
        $page = new Page([1, 2], new Pagination(1, 2), 10);

        $this->assertEquals(10, $page->getTotalCount());
    }
}
