<?php


namespace App\Tests\Service\IdGenerator;


use App\Service\IdGenerator\NanoIdGenerator;
use PHPUnit\Framework\TestCase;

class NanoIdGeneratorTest extends TestCase
{
    public function testGeneratedIdIsDifferent()
    {
        $generator = new NanoIdGenerator();

        $ids = [];
        for ($i = 0; $i < 20; $i++) {
            $ids[] = $generator->generate();
        }

        $counts = array_count_values($ids);

        foreach ($counts as $count) {
            $this->assertEquals(1, $count);
        }
    }
}