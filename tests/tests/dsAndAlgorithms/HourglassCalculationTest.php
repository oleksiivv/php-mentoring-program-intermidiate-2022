<?php

namespace tests\dsAndAlgorithms;

use PHPUnit\Framework\TestCase;
use src\dsAndAlgorithms\HourglassCalculation;

class HourglassCalculationTest extends TestCase
{
    /**
     * @dataProvider hourglassesSumDataProvider
     */
    public function testHourglassesCalculationWorksCorrectly(array $input, array $expectedHourglassesSums, int $expectedMaxHourglassSum)
    {
        $hourglassCalculation = new HourglassCalculation();

        $hourglassesSums = $hourglassCalculation->getHourglassesSums($input);

        $maxHourglassSum = $hourglassCalculation->getMaxHourglassSum($input);

        $this->assertSame($expectedHourglassesSums, $hourglassesSums);
        $this->assertSame($expectedMaxHourglassSum, $maxHourglassSum);
    }

    public function hourglassesSumDataProvider(): array
    {
        return [
            [
                [
                    [1, 1, 1],
                    [0, 1, 0],
                    [1, 1, 1],
                ],
                [
                  [7],
                ],
                7,
            ],
            [
                [
                    [1, 1, 1, 0, 0, 0],
                    [0, 1, 0, 0, 0, 0],
                    [1, 1, 1, 0, 0, 0],
                    [0, 0, 0, 4, 6, 5],
                    [0, 0, 0, 0, 7, 0],
                    [0, 0, 0, 9, 8, 4],
                ],
                [
                    [7, 4, 2, 0],
                    [2, 6, 10, 15],
                    [3, 2, 12, 13],
                    [0, 13, 27, 43],
                ],
                43,
            ],
        ];
    }
}