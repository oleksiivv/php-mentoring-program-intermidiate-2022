<?php

namespace Patterns\StrategyPattern\Strategies;

interface SortStrategyInterface
{
    public const ASCENDING_DIRECTION = 'asc';

    public const DESCENDING_DIRECTION = 'desc';

    public function sort(array $employees, string $direction): array;
}