<?php

namespace Patterns\AdapterPattern\Adapter;

use Patterns\AdapterPattern\Interfaces\ASCIIStackInterface;
use Patterns\AdapterPattern\Interfaces\IntegerStackInterface;

class IntegerStackDecorator implements ASCIIStackInterface
{
    public function __construct(public IntegerStackInterface $integerStack)
    {
    }

    public function push(string $data) : void
    {
        $this->integerStack->push((int) $data);
    }

    public function pop(): string
    {
        return (string) $this->integerStack->pop();
    }
}