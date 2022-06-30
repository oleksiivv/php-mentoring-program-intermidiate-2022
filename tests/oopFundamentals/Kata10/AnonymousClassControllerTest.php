<?php

namespace tests\oopFundamentals\Kata10;

use PHPUnit\Framework\TestCase;
use src\oopFundamentals\Kata10\AnonymousClassController;

class AnonymousClassControllerTest extends TestCase
{
    protected mixed $objectOrientedPhp;

    public function testAnonymousClassWorksCorrectly()
    {
        $objectOrientedPhp = (new AnonymousClassController())->getObjectOrientedPhpInstance();

        $name = 'Dave';
        $kataNumber = 5;

        $this->assertSame(10, $objectOrientedPhp->getKataCount());
        $this->assertSame(AnonymousClassController::COURSE_KATA_LIST[$kataNumber - 1], $objectOrientedPhp->getKataByNumber($kataNumber));

        $this->assertSame(
            sprintf(AnonymousClassController::COURSE_ADVERTISE_FORMAT, $name),
            $objectOrientedPhp->advertise($name),
        );

        $this->assertSame(
            AnonymousClassController::COURSE_COMPLETE_TEXT,
            $objectOrientedPhp->complete(),
        );

        $this->assertSame(
            sprintf(AnonymousClassController::AUTHOR_TO_STRING_FORMAT, AnonymousClassController::AUTHOR_NAME, AnonymousClassController::AUTHOR_AGE, AnonymousClassController::AUTHOR_OCCUPATION),
            strval($objectOrientedPhp->author),
        );

        $this->assertSame(
            AnonymousClassController::COURSE_DESCRIPTION,
            strval($objectOrientedPhp),
        );
    }
}