<?php

namespace App\Http\Annotation;

use Doctrine\Common\Annotations\Reader;

class AnnotationProcessor
{
    /** @var Reader */
    private $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    public function getMethodAnnotation(callable $controller, string $annotation): ?object
    {
        if (!is_array($controller)) {
            return null;
        }

        list($controllerObject, $methodName) = $controller;

        $controllerReflectionObject = new \ReflectionObject($controllerObject);

        return $this->reader->getMethodAnnotation(
            $controllerReflectionObject->getMethod($methodName),
            $annotation
        );
    }
}
