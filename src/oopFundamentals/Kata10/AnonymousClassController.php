<?php

namespace src\oopFundamentals\Kata10;

class AnonymousClassController
{
    public const GENDER_MALE = 'male';
    public const GENDER_FEMALE = 'female';

    public const AUTHOR_NAME = 'Barry Allen';
    public const AUTHOR_AGE = 27;
    public const AUTHOR_OCCUPATION = 'Scientist';
    public const AUTHOR_GENDER = self::GENDER_MALE;

    public const AUTHOR_TO_STRING_FORMAT = '%s, aged %d, who is %s';

    public const COURSE_ADVERTISE_FORMAT = 'Hey %s, don\'t forget to check out this great PHP Kata Series authored by Donald called "Object-Oriented PHP"';
    public const COURSE_COMPLETE_TEXT = 'Hooray, I\'ve finally completed the entire "Object-Oriented PHP" Kata Series!!!';
    public const COURSE_DESCRIPTION = 'Course description...';
    public const COURSE_KATA_LIST = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'];

    private mixed $objectOrientedPhp;

    public function __construct()
    {
        $this->objectOrientedPhp = require_once 'AnonymousClassInstance.php';
    }

    public function getObjectOrientedPhpInstance(): mixed
    {
        return $this->objectOrientedPhp;
    }
}