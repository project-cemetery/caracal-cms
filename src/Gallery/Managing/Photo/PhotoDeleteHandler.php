<?php

namespace App\Gallery\Managing\Photo;

use App\Gallery\PhotoRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Gallery\GalleryRepository;

class PhotoDeleteHandler implements MessageHandlerInterface
{
    /** @var EntityManagerInterface */
    private $em;

    /** @var PhotoRepository */
    private $photoRepo;

    public function __construct(EntityManagerInterface $em, PhotoRepository $photoRepo)
    {
        $this->em = $em;
        $this->photoRepo = $photoRepo;
    }

    public function __invoke(PhotoDeleteCommand $command): void
    {
        $id = $command->getId();
        $gallery = $this->photoRepo->get($id);

        $this->em->remove($gallery);
        $this->em->flush();
    }
}
