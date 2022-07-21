<?php

namespace solid\Entities;

use solid\Entities\Interfaces\BaseEntity;
use solid\Entities\Interfaces\HasAuthor;
use solid\Entities\Interfaces\PhysicalReadableObject;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="books")
 */
class Book implements BaseEntity, PhysicalReadableObject, HasAuthor
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

    /**
     * @ORM\Column(type="string")
     */
    private string $authorFullName;

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

    public function setAuthorFullName(string $authorFullName): void
    {
        $this->authorFullName = $authorFullName;
    }

    public function getAuthorFullName(): string
    {
        return $this->authorFullName;
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