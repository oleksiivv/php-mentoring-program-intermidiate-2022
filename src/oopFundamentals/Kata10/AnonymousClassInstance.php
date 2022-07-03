<?php

use src\oopFundamentals\Kata10\AnonymousClassController;

$author = new class(
    AnonymousClassController::AUTHOR_NAME,
    AnonymousClassController::AUTHOR_AGE,
    AnonymousClassController::AUTHOR_GENDER,
    AnonymousClassController::AUTHOR_OCCUPATION,
) {
    public function __construct(
        public string $name,
        public int $age,
        public string $gender,
        public string $occupation,
    ) {
    }

    public function __toString(): string
    {
        return sprintf(AnonymousClassController::AUTHOR_TO_STRING_FORMAT, $this->name, $this->age, $this->occupation);
    }
};

$objectOrientedPhp = new class(AnonymousClassController::COURSE_DESCRIPTION, AnonymousClassController::COURSE_KATA_LIST, $author) {
    private int $kataCount;

    public function __construct(
        public string $description,
        public array $kataList,
        public $author,
    ) {
        $this->kataCount = 10;
    }

    public function __toString(): string
    {
        return $this->description;
    }

    public function getKataCount(): int
    {
        return $this->kataCount;
    }

    public function advertise(string $name): string
    {
        return sprintf(AnonymousClassController::COURSE_ADVERTISE_FORMAT, $name);
    }

    public function getKataByNumber(int $kataNumber): string
    {
        if ($kataNumber > 10 || $kataNumber < 1) {
            throw new InvalidArgumentException('Kata number must be in diapason 1...10');
        }

        return $this->kataList[$kataNumber-1];
    }

    public function complete(): string
    {
        return AnonymousClassController::COURSE_COMPLETE_TEXT;
    }
};

return $objectOrientedPhp;