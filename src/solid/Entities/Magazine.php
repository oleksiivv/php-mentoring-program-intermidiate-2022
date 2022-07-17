<?php

namespace solid\Entities;

use solid\Entities\Interfaces\Arrayable;
use solid\Entities\Interfaces\BaseEntity;
use solid\Entities\Interfaces\PhysicalReadableObject;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="magazines")
 */
class Magazine implements BaseEntity, PhysicalReadableObject
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="integer")
     */
    private string $numberOfPages;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $hardCover;

    /**
     * @ORM\Column(type="string")
     */
    private string $description;

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setHardCover(bool $hardCover): void
    {
        $this->hardCover = $hardCover;
    }

    public function getHardCover(): bool
    {
        return $this->hardCover;
    }

    public function setNumberOfPages(int $numberOfPages): void
    {
        $this->numberOfPages = $numberOfPages;
    }

    public function getNumberOfPages(): int
    {
        return $this->numberOfPages;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function isExportable(): bool
    {
        return false;
    }
}