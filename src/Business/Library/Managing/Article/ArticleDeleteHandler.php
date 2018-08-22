<?php

namespace App\Business\Library\Managing\Article;

use App\Business\Library\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class ArticleDeleteHandler implements MessageHandlerInterface
{
    /** @var EntityManagerInterface */
    private $em;

    /** @var ArticleRepository */
    private $articleRepo;

    public function __construct(EntityManagerInterface $em, ArticleRepository $articleRepo)
    {
        $this->em = $em;
        $this->articleRepo = $articleRepo;
    }

    public function __invoke(ArticleDeleteCommand $command): void
    {
        $id = $command->getId();
        $article = $this->articleRepo->get($id);

        $this->em->remove($article);
        $this->em->flush();
    }
}
