<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    // TODO: pagination
    // TODO: doing
    /**
     * @Route("/articles", name="articles")
     */
    public function articlesAction() {

        return null;
    }

    // TODO: doing
    /**
     * @Route("/article/{id}", name="article")
     */
    public function articleAction($id = null) {
        return null;
    }

    public function showLastAction(int $limit = null) {
        /** @var Article[] $articles */
        $articles = $this
            ->getDoctrine()
            ->getRepository(Article::class)
            ->findLast($limit);

        return $this->render(
            '@THEME/parts/lastArticles.html.twig',
            ['articles' => $articles]
        );
    }

}
