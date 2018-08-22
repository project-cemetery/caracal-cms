<?php

namespace App\Business\Gallery\Managing\Gallery;

use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Business\Gallery\GalleryRepository;

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
