<?php

namespace App\Tests\Http\Response\EmptySuccess;

use App\Http\Response\EmptySuccess\EmptySuccessResponder;
use App\Http\Response\EmptySuccess\EmptySuccessResponse;
use Kamyshev\ResponderBundle\Responder\ResultMetadata;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

class EmptySuccessResponderTest extends TestCase
{
    public function testSupports()
    {
        $responder = new EmptySuccessResponder();

        $passMeta = new ResultMetadata(EmptySuccessResponse::class);
        $notPassMeta = new ResultMetadata('any string');

        $this->assertTrue($responder->supports(null, $passMeta));

        $this->assertFalse($responder->supports(null, $notPassMeta));
    }

    public function testMake()
    {
        $responder = new EmptySuccessResponder();

        $meta = new ResultMetadata(EmptySuccessResponse::class);
        $result = new EmptySuccessResponse();

        $response = $responder->make($result, $meta);

        $this->assertEquals(Response::HTTP_NO_CONTENT, $response->getStatusCode());
        $this->assertEquals('', $response->getContent());
    }
}
