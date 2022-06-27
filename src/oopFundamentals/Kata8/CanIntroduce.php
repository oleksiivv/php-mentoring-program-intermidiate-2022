<?php

namespace src\oopFundamentals\Kata8;

interface CanIntroduce extends CanSpeak
{
    public function introduce(): string;
}