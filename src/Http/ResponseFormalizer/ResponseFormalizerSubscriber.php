<?php

namespace App\Http\ResponseFormalizer;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;

class ResponseFormalizerSubscriber implements EventSubscriberInterface
{
    /** @var ResponseFormalizerInterface[] $formalizers */
    private $formalizers;

    public function __construct(iterable $formalizers)
    {
        $this->formalizers = (function (ResponseFormalizerInterface ...$formalizers) {
            return $formalizers;
        })(...$formalizers);
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $result = $event->getControllerResult();
        $meta = new ResponseMetadata(get_class($result));

        $specificFormalizer = array_find(
            $this->formalizers,
            function (ResponseFormalizerInterface $formalizer) use ($meta, $result) {
                return $formalizer->supports($result, $meta);
            }
        );

        if ($specificFormalizer) {
            $response = $specificFormalizer->make($result, $meta);
            $event->setResponse($response);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => 'onKernelView',
        ];
    }
}