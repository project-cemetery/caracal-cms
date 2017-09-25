<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Advert;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdvertController extends Controller
{
    /**
     * @Route("/adverts", name="adverts")
     */
    public function advertsAction() {
        $adverts = $this
            ->getDoctrine()
            ->getRepository(Advert::class)
            ->findBy([], ['createdAt' => 'DESC']);

        return $this->render(
            '@THEME/adverts.html.twig',
            ['adverts' => $adverts]
        );
    }

    /**
     * @Route("/advert/{id}", name="advert")
     */
    public function advertAction(int $id = null) {
        /** @var Advert $advert */
        $advert = $this
            ->getDoctrine()
            ->getRepository(Advert::class)
            ->find($id);

        return $this->render(
            '@THEME/advert.html.twig',
            ['advert' => $advert]
        );
    }

    public function showLastAction(int $limit = null) {
        /** @var Advert[] $adverts */
        $adverts = $this
            ->getDoctrine()
            ->getRepository(Advert::class)
            ->findLast($limit);

        return $this->render(
            '@THEME/parts/lastAdverts.html.twig',
            ['adverts' => $adverts]
        );
    }

}
