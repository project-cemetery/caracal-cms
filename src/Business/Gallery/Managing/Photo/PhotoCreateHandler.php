<?php

namespace App\Business\Gallery\Managing\Photo;

use App\Business\Gallery\GalleryRepository;
use App\Business\Gallery\Photo;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;

class PhotoCreateHandler implements MessageHandlerInterface
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

    public function __invoke(PhotoCreateCommand $command): void
    {
        $id = $command->getData()->getId();
        $link = $command->getData()->getLink();

        if (!$link) {
            throw new \InvalidArgumentException('"link" can not be null');
        }

        $photo = Photo::createEmpty($id, $link);

        $this->em->persist($photo);

        $command->getData()->updatePhoto($photo, $this->galleryRepo);

        $this->em->flush();
    }
}
