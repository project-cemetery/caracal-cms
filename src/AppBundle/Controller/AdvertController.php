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
        // TODO: doing
        return null;
    }

    /**
     * @Route("/adverts/{id}", name="advert")
     */
    public function advertAction(int $id = null) {
        // TODO: doing
        return null;
    }

    public function showLastAction($limit) {
        // TODO: получение последних объявлений
        $adverts = $this
            ->getDoctrine()
            ->getRepository(Advert::class)
            ->findAll();

        return $this->render(
            '@THEME/parts/lastAdverts.html.twig',
            [
                'adverts' => $adverts,
            ]
        );
    }

}
