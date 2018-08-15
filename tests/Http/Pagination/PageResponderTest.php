<?php

namespace App\Tests\Http\Pagination;

use PHPUnit\Framework\TestCase;
use App\Http\Pagination\PageResponder;
use Kamyshev\ResponderBundle\Responder\ResultMetadata;
use App\Http\Pagination\Page;
use Symfony\Component\Serializer\SerializerInterface;

class PageResponderTest extends TestCase
{
    public function testSupports()
    {
        $serializer = $this->createMock(SerializerInterface::class);

        $responder = new PageResponder($serializer);

        $passMeta = new ResultMetadata(Page::class);
        $this->assertTrue($responder->supports(null, $passMeta));

        $notPassMeta = new ResultMetadata('some string');
        $this->assertFalse($responder->supports(null, $notPassMeta));
    }
}
