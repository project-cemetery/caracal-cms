<?php


namespace App\Tests\Command;


use App\Command\Denormalizer;
use App\Command\NotImplementedException;
use PHPUnit\Framework\TestCase;

class DenormalizerTest extends TestCase
{
    public function testSupportsNormalizations()
    {
        $denormalizer = $this->getMockForAbstractClass(Denormalizer::class);

        $this->assertFalse($denormalizer->supportsNormalization([], 'any format'));
    }

    public function testNormalization()
    {
        $denormalizer = $this->getMockForAbstractClass(Denormalizer::class);

        $this->expectException(NotImplementedException::class);
        $denormalizer->normalize(new \stdClass());
    }
}