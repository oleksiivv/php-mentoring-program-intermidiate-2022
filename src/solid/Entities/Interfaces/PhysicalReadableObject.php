<?php

namespace solid\Entities\Interfaces;

interface PhysicalReadableObject
{
    public function setHardCover(bool $hardCover): void;

    public function getHardCover(): bool;
}