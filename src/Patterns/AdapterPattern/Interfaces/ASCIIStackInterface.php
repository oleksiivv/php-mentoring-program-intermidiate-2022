<?php

namespace Patterns\AdapterPattern\Interfaces;

interface ASCIIStackInterface
{
    public function push(string $data): void;

    public function pop(): string;
}