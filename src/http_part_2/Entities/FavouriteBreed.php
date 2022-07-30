<?php

namespace http_part_2\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use http_part_2\Entities\Breed;

/**
 * @ORM\Entity
 * @ORM\Table(name="favourite_breeds")
 */
class FavouriteBreed
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
    private string $imageId;

    /**
     * @ORM\Column(type="string")
     */
    private string $userApiKey;

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

    /**
     * @param string $userApiKey
     */
    public function setUserApiKey(string $userApiKey): void
    {
        $this->userApiKey = $userApiKey;
    }

    /**
     * @return string
     */
    public function getUserApiKey(): string
    {
        return $this->userApiKey;
    }

    public static function fromArray(array $data): self
    {
        $favouriteBreed = new self;

        $favouriteBreed->setUserApiKey($data['sub_id']);
        $favouriteBreed->setImageId($data['image_id']);
        $favouriteBreed->setId($data['id']);

        return $favouriteBreed;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'sub_id' => $this->getUserApiKey(),
            'image_id' => $this->getImageId(),
        ];
    }
}