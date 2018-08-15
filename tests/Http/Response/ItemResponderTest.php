<?php

namespace App\Tests\Http\Response;

use App\Http\Pagination\Page;
use App\Http\Pagination\Pagination;
use App\Http\Response\GalleryResponse;
use App\Http\Response\ItemResponder;
use App\Http\Response\PhotoResponse;
use Kamyshev\ResponderBundle\Responder\ResultMetadata;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\SerializerInterface;

class ItemResponderTest extends TestCase
{
    public function testSupports()
    {
        $passResponses = [
            new GalleryResponse('id', 'name', 'description', new \DateTimeImmutable(), []),
            new PhotoResponse('id', 'name', 'description', 'link'),
        ];

        $notPassResponses = [
            new Page([], new Pagination(1, 1), 1),
        ];

        $meta = new ResultMetadata('any type');

        $serializer = $this->createMock(SerializerInterface::class);

        $responder = new ItemResponder($serializer);

        foreach ($passResponses as $passResponse) {
            $this->assertTrue($responder->supports($passResponse, $meta));
        }

        foreach ($notPassResponses as $notPassResponse) {
            $this->assertFalse($responder->supports($notPassResponse, $meta));
        }
    }
}
