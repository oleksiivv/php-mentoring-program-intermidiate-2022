<?php

namespace Patterns\AdapterPattern;

use Patterns\AdapterPattern\Interfaces\IntegerStackInterface;
use SplStack;

class IntegerStack implements IntegerStackInterface
{
    public SplStack $splStack;

    public function __construct()
    {
        $this->splStack = new SplStack();
    }

    public function push(int $data): void
    {
        $this->splStack->push($data);
    }

    public function pop(): int
    {
        return $this->splStack->pop();
    }
}