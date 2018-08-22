<?php

namespace App\Sale\Managing;

use App\Sale\Ad;
use App\Sale\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AdCreateHandler implements MessageHandlerInterface
{
    /** @var EntityManagerInterface */
    private $em;

    /** @var AdRepository */
    private $adRepo;

    public function __construct(EntityManagerInterface $em, AdRepository $adRepo)
    {
        $this->em = $em;

        $this->adRepo = $adRepo;
    }

    public function __invoke(AdCreateCommand $command): void
    {
        $id = $command->getData()->getId();

        $ad = Ad::createEmpty($id);

        $this->em->persist($ad);

        $command->getData()->updateAd($ad);

        $this->em->flush();
    }
}
