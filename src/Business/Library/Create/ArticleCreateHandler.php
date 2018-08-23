<?php

namespace App\Business\Library\Create;

use App\Business\Library\Article;
use App\Business\Library\LibraryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class ArticleCreateHandler implements MessageHandlerInterface
{
    /** @var EntityManagerInterface */
    private $em;

    /** @var LibraryRepository */
    private $libraryRepo;

    public function __construct(EntityManagerInterface $em, LibraryRepository $libraryRepo)
    {
        $this->em = $em;

        $this->libraryRepo = $libraryRepo;
    }

    public function __invoke(ArticleCreateCommand $command): void
    {
        $id = $command->getData()->getId();

        $article = Article::createEmpty($id);

        $this->em->persist($article);

        $command->getData()->updateArticle($article, $this->libraryRepo);

        $this->em->flush();
    }
}
