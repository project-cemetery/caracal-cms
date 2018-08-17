<?php

namespace App\Gallery\Managing;

use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Gallery\Gallery;
use App\Gallery\GalleryRepository;
use App\Gallery\Photo;
use App\Gallery\PhotoRepository;

class GalleryDeleteHandler implements MessageHandlerInterface
{
    /** @var EntityManagerInterface */
    private $em;

    /** @var GalleryRepository */
    private $galleryRepo;

    public function __construct(EntityManagerInterface $em, GalleryRepository $galleryRepo)
    {
        $this->em = $em;
        $this->galleryRepo = $galleryRepo;
    }

    public function __invoke(GalleryDeleteCommand $command): void
    {
        $id = $command->getId();
        $gallery = $this->galleryRepo->get($id);

        $this->em->remove($gallery);
        $this->em->flush();
    }
}
