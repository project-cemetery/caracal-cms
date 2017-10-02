<?php

namespace AppBundle\Services;


use AppBundle\Entity\Advert;
use AppBundle\Entity\Article;
use AppBundle\Entity\Gallery;
use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManager;
use Dpn\XmlSitemapBundle\Sitemap\Entry;
use Dpn\XmlSitemapBundle\Sitemap\GeneratorInterface;
use Symfony\Component\Routing\Router;

class SitemapGenerator implements GeneratorInterface
{
    private $em;
    private $router;

    public function __construct(EntityManager $em, Router $router)
    {
        $this->em = $em;
        $this->router = $router;
    }

    public function generate()
    {
        $entries = [];

        $entries = array_merge($entries,
            $this->generateEntities(Article::class,
                function (Article $a) {
                    return $this->router->generate('article', ['id' => $a->getId()], Router::ABSOLUTE_URL);
                }
            )
        );
        $entries = array_merge($entries,
            $this->generateEntities(Advert::class,
                function (Advert $a) {
                    return $this->router->generate('advert', ['id' => $a->getId()], Router::ABSOLUTE_URL);
                }
            )
        );
        $entries = array_merge($entries,
            $this->generateEntities(Gallery::class,
                function (Gallery $g) {
                    return $this->router->generate('gallery', ['id' => $g->getId()], Router::ABSOLUTE_URL);
                }
            )
        );
        $entries = array_merge($entries,
            $this->generateEntities(Product::class,
                function (Product $p) {
                    return $this->router->generate('product', ['id' => $p->getId()], Router::ABSOLUTE_URL);
                }
            )
        );

        return $entries;
    }

    private function generateEntities(
        string $className,
        callable $generateRoute
    ): array {
        $entries = [];

        $entities = $this->em->getRepository($className)->findAll();

        foreach ($entities as $entity) {
            $entries[] = new Entry($generateRoute($entity));
        }

        return $entries;
    }
}