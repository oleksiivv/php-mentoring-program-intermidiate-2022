<?php

namespace src\oopFundamentals\Kata7;

use src\oopFundamentals\Kata6\Person as BasePerson;

class Person extends BasePerson
{
    public const INTRODUCE_STRING = 'Hello, my name is %s';

    public const GREET_EXTRATERRESTRIALS_STRING = 'Welcome to Planet Earth %s!';

    public const DESCRIBE_JOB_STRING = 'I am currently working as a(n) %s';

    public function introduce(): string
    {
        return sprintf(self::INTRODUCE_STRING, $this->name);
    }

    final public function greetExtraterrestrials(): string
    {
        return sprintf(self::GREET_EXTRATERRESTRIALS_STRING, self::SPECIES);
    }

    final public function describeJob(): string
    {
        return sprintf(self::DESCRIBE_JOB_STRING, $this->occupation);
    }
}