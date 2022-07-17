<?php

namespace solid\Entities\Interfaces;

interface HasAuthor
{
    public function setAuthorFullName(string $authorFullName): void;

    public function getAuthorFullName(): string;
}