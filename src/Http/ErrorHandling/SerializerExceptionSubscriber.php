<?php

namespace App\Http\ErrorHandling;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\Exception\MissingConstructorArgumentsException;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class SerializerExceptionSubscriber implements EventSubscriberInterface
{
    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
        $e = $event->getException();

        if ($e instanceof MissingConstructorArgumentsException) {
            throw new BadRequestHttpException('Invalid fields in request', $e);
        }

        if ($e instanceof NotEncodableValueException) {
            throw new BadRequestHttpException('Invalid JSON in request', $e);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }
}
