<?php

namespace App\Library;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Util\NanoId;

/**
 * @ORM\Entity(repositoryClass="App\Library\LibraryRepository")
 */
class Library
{
    // Constructors

    public static function createEmpty(): self
    {
        $instance = new self();

        $instance->id = NanoId::get();

        return $instance;
    }

    public static function create(string $name, ?string $description = null): self
    {
        $instance = self::createEmpty();

        $instance->name = $name;
        $instance->description = $description;

        return $instance;
    }

    // Behaviour

    public function rename(string $newName): void
    {
        $this->name = $newName;
    }

    public function changeDescription(string $newDescription): void
    {
        $this->description = $newDescription;
    }

    public function changeParent(self $parent): void
    {
        if ($this->parent === $parent) {
            return;
        }

        if ($this->parent) {
            $this->parent->removeChild($this);
        }

        $this->parent = $parent;

        $this->parent->addChild($this);
    }

    public function orphan(): void
    {
        if (!$this->parent) {
            return;
        }

        $this->parent->removeChild($this);

        $this->parent = null;
    }

    public function addChild(self $child): void
    {
        if ($this->children->contains($child)) {
            return;
        }

        $this->children->add($child);

        $child->changeParent($this);
    }

    public function removeChild(self $child): void
    {
        if (!$this->children->contains($child)) {
            return;
        }

        $this->children->removeElement($child);

        $child->orphan();
    }

    public function addArticle(Article $article): void
    {
        if ($this->articles->contains($article)) {
            return;
        }

        $this->articles->add($article);

        $article->moveToLibrary($this);
    }

    public function removeArticle(Article $article): void
    {
        if (!$this->articles->contains($article)) {
            return;
        }

        $this->articles->removeElement($article);

        $article->removeFromLibrary();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getChildren(): array
    {
        return $this->children->toArray();
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function getArticles(): ?array
    {
        return $this->articles->toArray();
    }

    // Internal

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->articles = new ArrayCollection();
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
     * @var Library|null
     *
     * @ORM\ManyToOne(targetEntity="Library")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Library", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\OneToMany(targetEntity="Article", mappedBy="library")
     */
    private $articles;
}
