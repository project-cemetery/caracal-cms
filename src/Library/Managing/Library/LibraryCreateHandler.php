<?php

namespace App\Library\Managing\Library;

use App\Library\ArticleRepository;
use App\Library\Library;
use App\Library\LibraryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class LibraryCreateHandler implements MessageHandlerInterface
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

    public function __invoke(LibraryCreateCommand $command): void
    {
        $id = $command->getData()->getId();

        $library = Library::createEmpty($id);

        $this->em->persist($library);

        $command->getData()->updateLibrary($library, $this->libraryRepo, $this->articleRepo);

        $this->em->flush();
    }
}
