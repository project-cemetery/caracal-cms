<?php

namespace App\Http\ErrorHandling;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Doctrine\ORM\EntityNotFoundException;

class EntityNotFoundExceptionSubscriber implements EventSubscriberInterface
{
    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
        $e = $event->getException();

        if ($e instanceof EntityNotFoundException) {
            throw new NotFoundHttpException($e->getMessage(), $e);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }
}
