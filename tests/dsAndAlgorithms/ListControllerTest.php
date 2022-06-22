<?php

namespace tests\dsAndAlgorithms;

use PHPUnit\Framework\TestCase;
use src\dsAndAlgorithms\ListController;

class ListControllerTest extends TestCase
{
    /**
     * @dataProvider hourglassesSumDataProvider
     */
    public function testAddElementAtBeginWorksCorrectly(array $elements, array $expectedOrder)
    {
        $listController = new ListController();

        foreach ($elements as $element) {
            $listController->addElementAtBegin($element);
        }

        $this->assertSame($expectedOrder, $listController->toArray());
    }

    public function hourglassesSumDataProvider(): array
    {
        return [
            [
                [23, 34, 56, 11, 0, 12],
                [12, 0, 11, 56, 34, 23],
            ],
            [
                [23, 34],
                [34, 23],
            ],
        ];
    }
}