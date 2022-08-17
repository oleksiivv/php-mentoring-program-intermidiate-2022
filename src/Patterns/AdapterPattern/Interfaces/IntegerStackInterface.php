<?php

namespace Patterns\AdapterPattern\Interfaces;

interface IntegerStackInterface
{
    public function push(int $data): void;

    public function pop(): int;
}