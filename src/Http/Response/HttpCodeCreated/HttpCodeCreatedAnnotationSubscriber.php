<?php

namespace App\Http\Response\HttpCodeCreated;

use Doctrine\Common\Annotations\Reader;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class HttpCodeCreatedAnnotationSubscriber implements EventSubscriberInterface
{
    /** @var Reader */
    private $reader;

    /** @var array */
    private $annotated = [];

    /** @var string */
    private const ANNOTATION = HttpCodeCreated::class;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    public function onController(FilterControllerEvent $event): void
    {
        $controller = $event->getController();

        if (!is_array($controller)) {
            return;
        }

        list($controllerObject, $methodName) = $controller;

        $controllerReflectionObject = new \ReflectionObject($controllerObject);

        $methodAnnotation = $this->reader->getMethodAnnotation(
            $controllerReflectionObject->getMethod($methodName),
            self::ANNOTATION
        );

        $requestIdentity = $this->requestIdentityString($event->getRequest());
        $this->annotated[$requestIdentity] = (bool) $methodAnnotation;
    }

    public function onResponse(FilterResponseEvent $event): void
    {
        $requestIdentity = $this->requestIdentityString($event->getRequest());

        if ($this->annotated[$requestIdentity]) {
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
