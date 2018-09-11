<?php

namespace App\Http\ErrorHandling;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class FileUploadingExceptionSubscriber implements EventSubscriberInterface
{
    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
        $e = $event->getException();

        if ($e instanceof \UnexpectedValueException) {
            throw new BadRequestHttpException('Invalid file in request', $e);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }
}
