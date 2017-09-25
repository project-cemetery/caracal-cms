<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repositories\ArticleRepository")
 * @Vich\Uploadable
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     * @var \DateTime
     */
    private $createdAt = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    private $title;

    /**
     * It only stores the name of the image associated with the product.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $image;

    /**
     * This unmapped property stores the binary contents of the image file
     * associated with the product.
     *
     * @Vich\UploadableField(mapping="article_images", fileNameProperty="image")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    private $enabled = false;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    private $hero = false;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $description;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    /**
     * @var Gallery
     *
     * @ORM\ManyToOne(targetEntity="Gallery")
     * @ORM\JoinColumn(name="gallery_id", referencedColumnName="id")
     */
    private $gallery;

    /**
     * @var ArticleCategory
     *
     * @ORM\ManyToOne(targetEntity="ArticleCategory", inversedBy="articles")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @var ArrayCollection | Tag[]
     *
     * @ORM\ManyToMany(targetEntity="Tag", cascade={"remove", "persist"})
     * @ORM\JoinTable(name="articles_tags",
     *      joinColumns={@ORM\JoinColumn(name="article_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id", unique=false)}
     *      )
     */
    private $tags;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->tags = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     * @return Article
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param File $image
     * @return Article
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $image
     * @return Article
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * @return Article
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function isHero(): bool
    {
        return $this->hero;
    }

    public function setHero(bool $hero): Article
    {
        $this->hero = $hero;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Article
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return Article
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * @param Gallery $gallery
     * @return Article
     */
    public function setGallery($gallery)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * @return ArticleCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param ArticleCategory $category
     *
     * @return Article
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }

    /**
     * @return ArrayCollection | Tag[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param ArrayCollection | Tag[] $tags
     * @return $this
     */
    public function setTags($tags) {
        $this->tags->clear();

        foreach ($tags as $tag) {
            $this->addTag($tag);
        }

        return $this;
    }

    /**
     * @param Tag $tag
     *
     * @return $this
     */
    public function removeTag(Tag $tag)
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    /**
     * @param Tag $tag
     *
     * @return $this
     */
    public function addTag(Tag $tag)
    {
        $this->tags->add($tag);

        return $this;
    }
}