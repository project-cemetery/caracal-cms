<?php

namespace App\Tests\Http\Pagination;

use App\Http\Pagination\Pagination;
use App\Http\Pagination\PaginationResolver;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class PaginationResolverTest extends TestCase
{
    public function testSupports()
    {
        $request = $this->createMock(Request::class);
        $passMeta = new ArgumentMetadata('name', Pagination::class, false, false, false);
        $notPassMeta = new ArgumentMetadata('name', 'any class', false, false, false);

        $resolver = new PaginationResolver();

        $this->assertTrue($resolver->supports($request, $passMeta));

        $this->assertFalse($resolver->supports($request, $notPassMeta));
    }

    public function testResolveRealPage()
    {
        $request = $this->createMock(Request::class);
        $request
            ->method('get')
            ->willReturnCallback(function ($key): string {
                return [
                    'page'    => '12',
                    'perPage' => '100',
                ][$key];
            });

        $meta = new ArgumentMetadata('name', Pagination::class, false, false, false);

        $resolver = new PaginationResolver();

        /** @var Pagination $pagination */
        $pagination = $resolver->resolve($request, $meta)->current();

        $this->assertNotNull($pagination);
        $this->assertEquals(12, $pagination->getPage());
        $this->assertEquals(100, $pagination->getPerPage());
    }

    public function testResolveDefaultPage()
    {
        $request = $this->createMock(Request::class);
        $request
            ->method('get')
            ->willReturnArgument(1);

        $meta = new ArgumentMetadata('name', Pagination::class, false, false, false);

        $resolver = new PaginationResolver();

        /** @var Pagination $pagination */
        $pagination = $resolver->resolve($request, $meta)->current();

        $this->assertNotNull($pagination);
        $this->assertEquals(1, $pagination->getPage());
        $this->assertEquals(10, $pagination->getPerPage());
    }
}
