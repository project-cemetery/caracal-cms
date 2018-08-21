<?php

namespace App\Http\Annotation\HttpCodeCreated;

use App\Http\Annotation\AnnotationProcessor;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class HttpCodeCreatedSubscriber implements EventSubscriberInterface
{
    /** @var AnnotationProcessor */
    private $annotationProcessor;

    /** @var array */
    private $annotated = [];

    public function __construct(AnnotationProcessor $annotationProcessor)
    {
        $this->annotationProcessor = $annotationProcessor;
    }

    public function onController(FilterControllerEvent $event): void
    {
        $annotation = $this->annotationProcessor->getMethodAnnotation(
            $event->getController(),
            HttpCodeCreated::class
        );

        $requestIdentity = $this->requestIdentityString($event->getRequest());
        $this->annotated[$requestIdentity] = (bool) $annotation;
    }

    public function onResponse(FilterResponseEvent $event): void
    {
        $requestIdentity = $this->requestIdentityString($event->getRequest());

        if ($this->annotated[$requestIdentity] && $event->getResponse()->getStatusCode() === Response::HTTP_OK) {
            $event
                ->getResponse()
                ->setStatusCode(Response::HTTP_CREATED);
        }
    }

    private function requestIdentityString(Request $request): string
    {
        return sprintf('%s %s', $request->getMethod(), $request->getPathInfo());
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onController',
            KernelEvents::RESPONSE   => 'onResponse',
        ];
    }
}
