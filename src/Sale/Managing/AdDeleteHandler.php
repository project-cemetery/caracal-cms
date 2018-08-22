<?php

namespace App\Sale\Managing;

use App\Sale\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AdDeleteHandler implements MessageHandlerInterface
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

    public function __invoke(AdDeleteCommand $command): void
    {
        $id = $command->getId();
        $ad = $this->adRepo->get($id);

        $this->em->remove($ad);
        $this->em->flush();
    }
}
