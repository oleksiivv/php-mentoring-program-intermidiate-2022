<?php

namespace src\oopFundamentals\Kata7;

use src\oopFundamentals\Kata6\Person as BasePerson;

class Person extends BasePerson
{
    public const INTRODUCE_FORMAT = 'Hello, my name is %s';

    public const GREET_EXTRATERRESTRIALS_FORMAT = 'Welcome to Planet Earth %s!';

    public const DESCRIBE_JOB_FORMAT = 'I am currently working as a(n) %s';

    public function introduce(): string
    {
        return sprintf(self::INTRODUCE_FORMAT, $this->name);
    }

    final public function greetExtraterrestrials(): string
    {
        return sprintf(self::GREET_EXTRATERRESTRIALS_FORMAT, self::SPECIES);
    }

    final public function describeJob(): string
    {
        return sprintf(self::DESCRIBE_JOB_FORMAT, $this->occupation);
    }
}