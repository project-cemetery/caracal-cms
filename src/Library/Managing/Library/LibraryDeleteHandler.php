<?php

namespace App\Library\Managing\Library;

use App\Library\LibraryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class LibraryDeleteHandler implements MessageHandlerInterface
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

    public function __invoke(LibraryDeleteCommand $command): void
    {
        $id = $command->getId();
        $article = $this->libraryRepo->get($id);

        $this->em->remove($article);
        $this->em->flush();
    }
}
