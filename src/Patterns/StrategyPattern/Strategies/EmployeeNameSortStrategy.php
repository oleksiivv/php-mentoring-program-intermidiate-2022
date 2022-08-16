<?php

namespace Patterns\StrategyPattern\Strategies;

use Illuminate\Support\Collection;

class EmployeeNameSortStrategy implements SortStrategyInterface
{
    public function sort(array $employees, string $direction): array
    {
        usort($employees, function ($a, $b) use ($direction) {
            return $direction === SortStrategyInterface::ASCENDING_DIRECTION
                ? $a->getName() > $b->getName()
                : $a->getName() < $b->getName();
        });

        return $employees;
    }
}