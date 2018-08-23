<?php

namespace App\Tests\Command;

use App\Business\Gallery\Managing\Gallery\GalleryData;
use App\Business\Gallery\Managing\Photo\PhotoEditCommand;
use App\Business\Library\Managing\Article\ArticleDeleteCommand;
use App\Command\CommandDenormalizer;
use App\Command\DataCommandDenormalizer;
use App\Command\NotImplementedException;
use App\Business\Gallery\Managing\Gallery\GalleryCreateCommand;
use App\Business\Gallery\Managing\Gallery\GalleryEditCommand;
use App\Business\Gallery\Managing\Photo\PhotoDeleteCommand;
use PHPUnit\Framework\TestCase;

class DataCommandDenormalizerTest extends TestCase
{

    public function testDenormalize()
    {
        $denormalizer = new DataCommandDenormalizer();

        $command = $denormalizer->denormalize(
            [
                'name' => 'new name',
            ],
            GalleryEditCommand::class,
            null,
            [
                'default_constructor_arguments' => [
                    GalleryData::class => [
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
        $denormalizer = new DataCommandDenormalizer();

        $passTypes = [
            GalleryEditCommand::class,
            GalleryCreateCommand::class,
            PhotoEditCommand::class,
        ];

        $notPassTypes = [
            'not pass type',
            'again',
            ArticleDeleteCommand::class,
        ];

        foreach ($passTypes as $passType) {
            $this->assertTrue($denormalizer->supportsDenormalization([], $passType));
        }

        foreach ($notPassTypes as $notPassType) {
            $this->assertFalse($denormalizer->supportsDenormalization([], $notPassType));
        }
    }
}
