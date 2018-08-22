<?php

namespace App\Sale;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Ad
{
    // Constructors

    public static function createEmpty(string $id): self
    {
        $instance = new self();

        $instance->id = $id;

        return $instance;
    }

    public static function create(
        string $id,
        string $name,
        string $body,
        array $images = [],
        \DateTimeImmutable $expireAt = null
    ): self {
        $instance = self::createEmpty($id);

        $instance->name = $name;
        $instance->body = $body;

        $instance->images = (function (string ...$images): array {
            return $images;
        })(...$images);

        $instance->expireAt = $expireAt;

        return $instance;
    }

    // Behaviour

    public function rename(string $newName): void
    {
        $this->name = $newName;
    }

    public function changeBody(string $newBody): void
    {
        $this->body = $newBody;
    }

    public function addImage(string $image): void
    {
        if (in_array($image, $this->images)) {
            return;
        }

        $this->images[] = $image;
    }

    public function removeImage(string $image): void
    {
        $this->images = array_filter(
            $this->images,
            function (string $i) use (&$image): bool {
                return $i !== $image;
            }
        );
    }

    public function updateImages(array $newImages): void
    {
        $newImages = (function (string ...$newImages): array {
            return $newImages;
        })(...$newImages);

        $oldImages = $this->getImages();

        foreach ($oldImages as $image) {
            $this->removeImage($image);
        }

        foreach ($newImages as $image) {
            $this->addImage($image);
        }
    }

    public function changeExpireDate(\DateTimeImmutable $newExpireDate): void
    {
        $this->expireAt = $newExpireDate;
    }

    public function eternalize(): void
    {
        $this->expireAt = null;
    }

    public function publish(): void
    {
        $this->published = true;
    }

    public function unpublish(): void
    {
        $this->published = false;
    }

    // Data

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    /** @return string[] */
    public function getImages(): array
    {
        return $this->images;
    }

    public function getExpireAt(): ?\DateTimeImmutable
    {
        return $this->expireAt;
    }

    public function isPublished(): bool
    {
        return $this->published;
    }

    // Internal

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=32)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $body;

    /**
     * @ORM\Column(type="json_array")
     */
    private $images = [];

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $expireAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $published = false;
}
