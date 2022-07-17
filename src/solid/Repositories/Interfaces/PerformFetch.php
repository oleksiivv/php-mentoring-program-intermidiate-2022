<?php

namespace solid\Repositories\Interfaces;

use solid\Entities\Interfaces\BaseEntity;
use solid\Entities\Interfaces\ReadableObject;

interface PerformFetch
{
    public function index(int $start=0, int $offset=10, ?array $order = null, ?array $criteria = []): array;

    public function find(int $id): ?BaseEntity;

    public function getNumberOfRecords(?array $criteria = []): int;
}