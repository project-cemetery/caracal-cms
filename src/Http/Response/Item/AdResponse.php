<?php

namespace App\Http\Response\Item;

use App\Sale\Ad;

class AdResponse implements ItemResponse
{
    public static function fromEntity(Ad $ad): self
    {
        return new self(
            $ad->getId(),
            $ad->getName() ?? '',
            $ad->getBody() ?? '',
            $ad->getImages(),
            $ad->getExpireAt(),
            $ad->isPublished()
        );
    }

    public function __construct(
        string $id,
        string $name,
        string $body,
        array $images,
        ?\DateTimeImmutable $expireAt,
        bool $published
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->body = $body;
        $this->images = (function (string ...$images): array {
            return $images;
        })(...$images);
        $this->expireAt = $expireAt;
        $this->published = $published;
    }

    /** @var string */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $body;
    /** @var string[] */
    private $images;
    /** @var \DateTimeImmutable|null */
    private $expireAt;
    /** @var bool */
    private $published;
}
