<?php

namespace App\Gallery\Managing;

use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Gallery\{Gallery, GalleryRepository, Photo, PhotoRepository};

class GalleryEditHandler implements MessageHandlerInterface
{
    /** @var EntityManagerInterface */
    private $em;

    /** @var GalleryRepository */
    private $galleryRepo;
    /** @var PhotoRepository */
    private $photoRepo;

    public function __construct(
        EntityManagerInterface $em,
        GalleryRepository $galleryRepo,
        PhotoRepository $photoRepo
    ) {
        $this->em = $em;

        $this->galleryRepo = $galleryRepo;
        $this->photoRepo = $photoRepo;
    }

    public function __invoke(GalleryEditCommand $command): void
    {
        $gallery = $this->galleryRepo->get($command->getId());

        $newName = $command->getName();
        if (!is_null($newName)) {
            $gallery->rename($newName);
        }

        $newDescription = $command->getDescription();
        if (!is_null($newDescription)) {
            $gallery->changeDescription($newDescription);
        }

        $newPhotoIds = $command->getPhotoIds();
        if (!is_null($newPhotoIds)) {
            $this->adjustPhotos($newPhotoIds, $gallery);
        }

        $this->em->flush();
    }

    public function adjustPhotos(array $photoIds, Gallery $gallery): void
    {
        /** @var Photo[] $newPhotos */
        $newPhotos = $this->photoRepo->getAllByIds($photoIds);

        /** @var Photo[] $oldPhotos */
        $oldPhotos = $gallery->getPhotos();

        foreach ($oldPhotos as $photo) {
            $gallery->removePhoto($photo);
        }

        foreach ($newPhotos as $photo) {
            $gallery->addPhoto($photo);
        }
    }
}
