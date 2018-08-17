<?php

namespace App\Editor;

use App\Gallery\Gallery;

class GalleryEditCommand implements EditCommand
{
    public function __construct(
        string $id,
        string $name,
        string $description,
        \DateTimeImmutable $createdAt = null,
        array $photoIds = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->photoIds = $photoIds;
    }

    public function supports($entity): bool
    {
        return $entity instanceof Gallery;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getPhotoIds(): ?array
    {
        return $this->photoIds;
    }

    /** @var string */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $description;
    /** @var \DateTimeImmutable|null */
    private $createdAt;
    /** @var array|null */
    private $photoIds;
}
