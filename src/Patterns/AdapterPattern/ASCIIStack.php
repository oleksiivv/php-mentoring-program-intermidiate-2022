<?php

namespace Patterns\AdapterPattern;

use Patterns\AdapterPattern\Interfaces\ASCIIStackInterface;
use SplStack;

class ASCIIStack implements ASCIIStackInterface
{
    public SplStack $splStack;

    public function __construct()
    {
        $this->splStack = new SplStack();
    }

    public function push(string $data): void
    {
        $this->splStack->push($data);
    }

    public function pop(): string
    {
        return $this->splStack->pop();
    }
}