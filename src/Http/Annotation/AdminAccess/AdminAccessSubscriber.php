<?php

namespace App\Http\Annotation\AdminAccess;

use App\Http\Annotation\AnnotationProcessor;
use App\Http\Security\AdminVoter;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AdminAccessSubscriber implements EventSubscriberInterface
{
    /** @var AnnotationProcessor */
    private $annotationProcessor;

    /** @var AuthorizationCheckerInterface */
    private $authChecker;

    public function __construct(AnnotationProcessor $annotationProcessor, AuthorizationCheckerInterface $authChecker)
    {
        $this->annotationProcessor = $annotationProcessor;
        $this->authChecker = $authChecker;
    }

    public function onController(FilterControllerEvent $event): void
    {
        $annotation = $this->annotationProcessor->getMethodAnnotation(
            $event->getController(),
            AdminAccess::class
        );

        if ($annotation) {
            $this->checkAccess();
        }
    }

    private function checkAccess(): void
    {
        $granted = $this->authChecker->isGranted(AdminVoter::ADMIN_ACCESS);

        if (!$granted) {
            throw new AccessDeniedException();
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onController',
        ];
    }
}
