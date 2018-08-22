<?php

namespace App\Business\Library\Managing\Article;

use App\Business\Library\ArticleRepository;
use App\Business\Library\LibraryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class ArticleEditHandler implements MessageHandlerInterface
{
    /** @var EntityManagerInterface */
    private $em;

    /** @var ArticleRepository */
    private $articleRepo;
    /** @var LibraryRepository */
    private $libraryRepo;

    public function __construct(
        EntityManagerInterface $em,
        ArticleRepository $articleRepo,
        LibraryRepository $libraryRepo
    ) {
        $this->em = $em;

        $this->articleRepo = $articleRepo;
        $this->libraryRepo = $libraryRepo;
    }

    public function __invoke(ArticleEditCommand $command): void
    {
        $id = $command->getData()->getId();
        $article = $this->articleRepo->get($id);

        $command->getData()->updateArticle($article, $this->libraryRepo);

        $this->em->flush();
    }
}
