<?php

namespace App\Gallery;

use App\Command\EditCommand;

class GalleryEditCommand implements EditCommand
{
    public function __construct(
        string $id,
        string $name = null,
        string $description = null,
        array $photoIds = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;

        $this->photoIds = is_null($photoIds)
            ? null
            : (function (string ...$photoIds): array {
                return $photoIds;
            })(...$photoIds);
    }

    public function supports($entity): bool
    {
        return $entity instanceof Gallery;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPhotoIds(): ?array
    {
        return $this->photoIds;
    }

    /** @var string */
    private $id;
    /** @var string|null */
    private $name;
    /** @var string|null */
    private $description;
    /** @var array|null */
    private $photoIds;
}
