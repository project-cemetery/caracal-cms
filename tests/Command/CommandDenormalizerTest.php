<?php

namespace App\Tests\Command;

use App\Command\CommandDenormalizer;
use App\Command\NotImplementedException;
use App\Gallery\Managing\Gallery\GalleryCreateCommand;
use App\Gallery\Managing\Gallery\GalleryEditCommand;
use App\Gallery\Managing\Photo\PhotoDeleteCommand;
use PHPUnit\Framework\TestCase;

class CommandDenormalizerTest extends TestCase
{
    public function testDenormalize()
    {
        $denormalizer = new CommandDenormalizer();

        $command = $denormalizer->denormalize(
            [
                'name' => 'new name',
            ],
            GalleryEditCommand::class,
            null,
            [
                'default_constructor_arguments' => [
                    GalleryEditCommand::class => [
                        'id' => '1',
                    ],
                ],
            ]
        );

        $this->assertEquals('1', $command->getData()->getId());
        $this->assertEquals('new name', $command->getData()->getName());
        $this->assertNull($command->getData()->getDescription());
    }

    public function testSupportsDenormalization()
    {
        $denormalizer = new CommandDenormalizer();

        $passTypes = [
            GalleryEditCommand::class,
            GalleryCreateCommand::class,
            PhotoDeleteCommand::class,
        ];

        $notPassTypes = [
            'not pass type',
            'again',
        ];

        foreach ($passTypes as $passType) {
            $this->assertTrue($denormalizer->supportsDenormalization([], $passType));
        }

        foreach ($notPassTypes as $notPassType) {
            $this->assertFalse($denormalizer->supportsDenormalization([], $notPassType));
        }
    }

    public function testSupportsNormalizations()
    {
        $denormalizer = new CommandDenormalizer();

        $this->assertFalse($denormalizer->supportsNormalization([], 'any format'));
    }

    public function testNormalization()
    {
        $denormalizer = new CommandDenormalizer();

        $this->expectException(NotImplementedException::class);
        $denormalizer->normalize(new \stdClass());
    }
}
