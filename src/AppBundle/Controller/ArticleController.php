<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    // TODO: pagination
    /**
     * @Route("/articles/{id}", name="articles")
     */
    public function articlesAction(int $id = null) {
        $articlesRepo = $this->getDoctrine()->getRepository(Article::class);

        $category = null;

        if ($id) {
            $category = $this
                ->getDoctrine()
                ->getRepository(ArticleCategory::class)
                ->find($id);

            $articles = $articlesRepo
                ->findBy(
                    ['category' => $id],
                    ['createdAt' => 'DESC']
                );
        } else {
            $articles = $articlesRepo->findBy([], ['createdAt' => 'DESC']);
        }

        return $this->render(
            '@THEME/articles.html.twig',
            [
                'articles' => $articles,
                'category' => $category,
            ]
        );
    }

    /**
     * @Route("/article/{id}", name="article")
     */
    public function articleAction($id = null) {
        $article = $this
            ->getDoctrine()
            ->getRepository(Article::class)
            ->find($id);

        return $this->render(
            '@THEME/article.html.twig',
            ['article' => $article]
        );
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
