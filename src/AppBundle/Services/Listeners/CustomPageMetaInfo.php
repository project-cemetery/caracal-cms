<?php

namespace AppBundle\Services\Listeners;


use AppBundle\Entity\PageMetaInfo;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class CustomPageMetaInfo
{
    protected $twig;
    protected $em;

    public function __construct(EntityManager $entityManager, \Twig_Environment $twig)
    {
        $this->twig = $twig;
        $this->em = $entityManager;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $path = $event->getRequest()->getPathInfo();
        $repository = $this->em->getRepository(PageMetaInfo::class);

        /** @var PageMetaInfo $pageMetaInfo */
        $pageMetaInfo = $repository->findOneBy(['path' => $path]);

        $title = null;
        $keywords = null;
        $description = null;

        if ($pageMetaInfo) {
            $title = $pageMetaInfo->getTitle();
            $keywords = $pageMetaInfo->getKeywords();
            $description = $pageMetaInfo->getDescription();
        }

        $this->twig->addGlobal('custom_seo_title', $title);
        $this->twig->addGlobal('custom_seo_keywords', $keywords);
        $this->twig->addGlobal('custom_seo_description', $description);
    }
}