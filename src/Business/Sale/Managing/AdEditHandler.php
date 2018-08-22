<?php

namespace App\Business\Sale\Managing;

use App\Business\Sale\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AdEditHandler implements MessageHandlerInterface
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

    public function __invoke(AdEditCommand $command): void
    {
        $id = $command->getData()->getId();
        $ad = $this->adRepo->get($id);

        $command->getData()->updateAd($ad);

        $this->em->flush();
    }
}
