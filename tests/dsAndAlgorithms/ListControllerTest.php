<?php

namespace Tests\dsAndAlgorithms;

use PHPUnit\Framework\TestCase;
use dsAndAlgorithms\ListController;

class ListControllerTest extends TestCase
{
    /**
     * @dataProvider listDataProvider
     */
    public function testAddElementAtBeginningWorksCorrectly(array $elements, array $expectedOrder)
    {
        $listController = new ListController();

        foreach ($elements as $element) {
            $listController->addElementAtBeginning($element);
        }

        $this->assertSame($expectedOrder, $listController->toArray());
    }

    public function listDataProvider(): array
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