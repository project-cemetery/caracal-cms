<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SocialLink;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class SocialLinkController extends Controller
{
    public function showAllAction() {
        /** @var SocialLink[] $links */
        $links = $this
            ->getDoctrine()
            ->getRepository(SocialLink::class)
            ->findAll();

        return $this->render(
            '@THEME/parts/socialLinks.html.twig',
            ['links' => $links]
        );
    }

}
