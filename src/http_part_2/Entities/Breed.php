<?php

namespace http_part_2\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="breeds")
 */
class Breed
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
     * @ORM\Column(type="string")
     */
    private string $temperament;

    /**
     * @ORM\Column(type="string")
     */
    private string $lifeSpan;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $wikipediaUrl;

    /**
     * @ORM\Column(type="string")
     */
    private string $imageId;

    /**
     * @ORM\Column(type="string")
     */
    private string $origin;

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $lifeSpan
     */
    public function setLifeSpan(string $lifeSpan): void
    {
        $this->lifeSpan = $lifeSpan;
    }

    /**
     * @return string
     */
    public function getLifeSpan(): string
    {
        return $this->lifeSpan;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $origin
     */
    public function setOrigin(string $origin): void
    {
        $this->origin = $origin;
    }

    /**
     * @return string
     */
    public function getOrigin(): string
    {
        return $this->origin;
    }

    /**
     * @param string $temperament
     */
    public function setTemperament(string $temperament): void
    {
        $this->temperament = $temperament;
    }

    /**
     * @return string
     */
    public function getTemperament(): string
    {
        return $this->temperament;
    }

    /**
     * @param ?string $wikipediaUrl
     */
    public function setWikipediaUrl(?string $wikipediaUrl): void
    {
        $this->wikipediaUrl = $wikipediaUrl;
    }

    /**
     * @return ?string
     */
    public function getWikipediaUrl(): ?string
    {
        return $this->wikipediaUrl;
    }

    /**
     * @param string $imageId
     */
    public function setImageId(string $imageId): void
    {
        $this->imageId = $imageId;
    }

    /**
     * @return string
     */
    public function getImageId(): string
    {
        return $this->imageId;
    }

    public static function fromArray(array $data): self
    {
        $breed = new self;

        $breed->setName($data['name']);
        $breed->setLifeSpan($data['life_span']);
        $breed->setOrigin($data['origin']);
        $breed->setTemperament($data['temperament']);
        $breed->setWikipediaUrl($data['wikipedia_url'] ?? null);
        $breed->setImageId($data['image']->id ?? 1);

        return $breed;
    }
}