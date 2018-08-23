<?php

namespace App\Business\Library;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Business\Library\ArticleRepository")
 */
class Article
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
        ?string $description = null
    ): self {
        $instance = self::createEmpty($id);

        $instance->name = $name;
        $instance->body = $body;
        $instance->description = $description;

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

    public function changeDescription(string $newDescription): void
    {
        $this->description = $newDescription;
    }

    public function moveToLibrary(Library $library): void
    {
        if ($this->library === $library) {
            return;
        }

        if ($this->library) {
            $this->library->removeArticle($this);
        }

        $this->library = $library;

        $this->library->addArticle($this);
    }

    public function removeFromLibrary(): void
    {
        if (!$this->library) {
            return;
        }

        $this->library->removeArticle($this);

        $this->library = null;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getLibrary(): ?Library
    {
        return $this->library;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    // Internal

    public function __construct()
    {
        $this->defineCreatedAtValue();
    }

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
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $body;

    /**
     * @ORM\ManyToOne(targetEntity="Library", inversedBy="articles")
     * @ORM\JoinColumn(name="library_id", referencedColumnName="id")
     */
    private $library;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=false)
     */
    private $createdAt;

    private function defineCreatedAtValue(): void
    {
        if (!$this->createdAt) {
            $this->createdAt = new \DateTimeImmutable();
        }
    }
}
