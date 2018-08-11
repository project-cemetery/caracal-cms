<?php

namespace App\Tests\Http\Pagination;

use PHPUnit\Framework\TestCase;
use App\Http\Pagination\PageResponder;
use Kamyshev\ResponderBundle\Responder\ResultMetadata;
use App\Http\Pagination\Page;
use App\Http\Pagination\Pagination;
use Symfony\Component\Serializer\SerializerInterface;

class PageResponderTest extends TestCase
{
    public function testSupports()
    {
        $serializer = $this->mockSerializer();

        $responder = new PageResponder($serializer);

        $passMeta = new ResultMetadata(Page::class);
        $this->assertTrue($responder->supports(null, $passMeta));

        $notPassMeta = new ResultMetadata('some string');
        $this->assertFalse($responder->supports(null, $notPassMeta));
    }

    public function testMake()
    {
        $serializer = $this->mockSerializer();

        $responder = new PageResponder($serializer);

        $page = new Page([], new Pagination(1, 10), 12);
        $meta = new ResultMetadata(Page::class);

        $response = $responder->make($page, $meta);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('{}', $response->getContent());
    }

    private function mockSerializer()
    {
        $serializer = $this->createMock(SerializerInterface::class);

        return $serializer;
    }
}
