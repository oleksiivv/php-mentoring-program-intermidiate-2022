<?php

namespace tests\dsAndAlgorithms;

use src\dsAndAlgorithms\ArrayRotation;
use PHPUnit\Framework\TestCase;

class ArrayRotationTest extends TestCase
{
    /**
     * @dataProvider arrayDataProvider
     */
    public function testPerformArrayRotationWorksCorrectly(array $input, int $step, array $expectedResult)
    {
        $result = (new ArrayRotation())->perform($input, $step);

        $this->assertSame($expectedResult, $result);
    }

    public function arrayDataProvider(): array
    {
        return [
            [
                [4, 5, 6, 7, 8],
                2,
                [6, 7, 8, 4, 5],
            ],
            [
                [4, 5, 6, 7, 8],
                1,
                [5, 6, 7, 8, 4],
            ],
            [
                [4, 5, 6, 7, 8],
                5,
                [4, 5, 6, 7, 8],
            ],
        ];
    }
}