<?php

namespace App\Business\Sale;

class AdData
{
    public function __construct(
        string $id,
        string $name = null,
        string $body = null,
        array $images = null,
        \DateTimeImmutable $expireAt = null,
        bool $published = null,
        bool $eternal = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->body = $body;
        $this->images = is_null($images)
            ? null
            : (function (string ...$images): array {
                return $images;
            })(...$images);
        $this->expireAt = $expireAt;
        $this->published = $published;
        $this->eternal = $eternal;
    }

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

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function getExpireAt(): ?\DateTimeImmutable
    {
        return $this->expireAt;
    }

    public function isPublished(): ?bool
    {
        return $this->published;
    }

    public function isEternal(): ?bool
    {
        return $this->eternal;
    }

    public function updateAd(Ad $ad): void
    {
        $newName = $this->getName();
        if (!is_null($newName)) {
            $ad->rename($newName);
        }

        $newBody = $this->getBody();
        if (!is_null($newBody)) {
            $ad->changeBody($newBody);
        }

        $newImages = $this->getImages();
        if (!is_null($newImages)) {
            $ad->updateImages($newImages);
        }

        $this->updateAdPublicationStatus($ad);
    }

    private function updateAdPublicationStatus(Ad $ad): void
    {
        $newExpireAt = $this->getExpireAt();
        if (!is_null($newExpireAt)) {
            $ad->changeExpireDate($newExpireAt);
        }

        $nowIsPublished = $this->isPublished();
        if (!is_null($nowIsPublished)) {
            if ($nowIsPublished) {
                $ad->publish();
            } else {
                $ad->unpublish();
            }
        }

        $nowIsEternal = $this->isEternal();
        if (!is_null($nowIsEternal)) {
            if ($nowIsEternal) {
                $ad->eternalize();
            }
        }
    }

    /** @var string */
    private $id;
    /** @var string|null */
    private $name;
    /** @var string|null */
    private $body;
    /** @var string[]|null */
    private $images;
    /** @var \DateTimeImmutable|null */
    private $expireAt;
    /** @var bool|null */
    private $published;
    /** @var bool|null */
    private $eternal;
}
