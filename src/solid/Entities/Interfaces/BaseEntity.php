<?php

namespace solid\Entities\Interfaces;

interface BaseEntity extends Arrayable
{
    public function setId(int $id): void;

    public function getId(): int;

    public function isExportable(): bool;
}