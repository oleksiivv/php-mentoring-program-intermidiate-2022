<?php

namespace Patterns\StrategyPattern\Strategies;

use Illuminate\Support\Collection;

class DepartmentNameSortStrategy implements SortStrategyInterface
{
    public function sort(array $employees, string $direction): array
    {
        usort($employees, function ($a, $b) use ($direction) {
            return $direction === SortStrategyInterface::ASCENDING_DIRECTION
                ? $a->getDepartment()->getName() > $b->getDepartment()->getName()
                : $a->getDepartment()->getName() < $b->getDepartment()->getName();
        });

        return $employees;
    }
}