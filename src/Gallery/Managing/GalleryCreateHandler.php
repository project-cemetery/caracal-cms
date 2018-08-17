<?php

namespace App\Gallery\Managing;

use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Gallery\Gallery;
use App\Gallery\GalleryRepository;
use App\Gallery\Photo;
use App\Gallery\PhotoRepository;

class GalleryCreateHandler implements MessageHandlerInterface
{
    /** @var EntityManagerInterface */
    private $em;

    /** @var PhotoRepository */
    private $photoRepo;

    public function __construct(
        EntityManagerInterface $em,
        PhotoRepository $photoRepo
    ) {
        $this->em = $em;

        $this->photoRepo = $photoRepo;
    }

    public function __invoke(GalleryCreateCommand $command): void
    {
        $id = $command->getData()->getId();

        $gallery = Gallery::createEmpty($id);

        $this->em->persist($gallery);

        $command->getData()->updateGallery($gallery, $this->photoRepo);

        $this->em->flush();
    }
}
