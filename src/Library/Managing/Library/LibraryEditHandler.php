<?php

namespace App\Library\Managing\Library;

use App\Library\ArticleRepository;
use App\Library\LibraryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class LibraryEditHandler implements MessageHandlerInterface
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

    public function __invoke(LibraryEditCommand $command): void
    {
        $id = $command->getData()->getId();
        $library = $this->libraryRepo->get($id);

        $command->getData()->updateLibrary($library, $this->libraryRepo, $this->articleRepo);

        $this->em->flush();
    }
}
