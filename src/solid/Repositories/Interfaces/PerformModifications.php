<?php

namespace solid\Repositories\Interfaces;

use solid\Entities\Interfaces\BaseEntity;
use solid\Entities\Interfaces\ReadableObject;

interface PerformModifications
{
    public function create(array $data): BaseEntity;

    public function update(int $id, array $data): BaseEntity;

    public function delete(int $id): void;
}