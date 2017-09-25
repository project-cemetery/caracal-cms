<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Repositories\ArticleRepository;
use AppBundle\Utils\Model\Pagination;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    /**
     * @Route("/articles/{id}/{page}", name="articles")
     */
    public function articlesAction(int $id = null, int $page = 1) {
        /** @var ArticleRepository $articlesRepo */
        $articlesRepo = $this->getDoctrine()->getRepository(Article::class);

        $category = null;

        $filters = [];
        $filters['enabled'] = true;

        if ($id) {
            $category = $this
                ->getDoctrine()
                ->getRepository(ArticleCategory::class)
                ->find($id);

            $filters['category'] = $category;
        }

        $articles = $articlesRepo->findFilteredByPage($filters, $page);

        $pages = [];
        for (
            $i = 1;
            $i <= ceil($articlesRepo->getFilteredCount($filters) / ArticleRepository::DEFAULT_ENTITIES_PER_PAGE);
            $i ++
        ) {
            $pages[] = $i;
        }
        $pagination = new Pagination($pages, $page);

        return $this->render(
            '@THEME/articles.html.twig',
            [
                'articles'   => $articles,
                'category'   => $category,
                'pagination' => $pagination,
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

    public function showHeroAction() {
        $article = $this
            ->getDoctrine()
            ->getRepository(Article::class)
            ->findOneHero();

        return $this->render(
            '@THEME/parts/heroArticle.html.twig',
            ['article' => $article]
        );
    }
}
