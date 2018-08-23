<?php

namespace App\Command;

/** @psalm-suppress PropertyNotSetInConstructor */
class DataCommandDenormalizer extends Denormalizer
{
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $commandReflector = new \ReflectionClass($class);

        $namedConstructor = $this->arrayToElement(
            $commandReflector->getMethods(\ReflectionMethod::IS_STATIC)
        );

        $constructorArgument = $this->arrayToElement(
            $namedConstructor->getParameters()
        );

        $dataType = $constructorArgument->getType()->getName();

        $dataReflector = new \ReflectionClass($dataType);

        $overwriteData = $context['default_constructor_arguments'][$class];
        foreach ($overwriteData as $key => $value) {
            $data[$key] = $value;
        }

        $allowedAttributes = $this->getAllowedAttributes($dataType, $context);

        $commandData = $this->instantiateObject($data, $dataType, $context, $dataReflector, $allowedAttributes);

        return $namedConstructor->invoke(null, $commandData);
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return is_subclass_of($type, CreateCommand::class) || is_subclass_of($type, EditCommand::class);
    }

    /** @return mixed */
    private function arrayToElement(array $arr, string $errorMessage = null)
    {
        $arr = array_values($arr);

        if (count($arr) !== 1) {
            throw new \InvalidArgumentException($errorMessage ?? 'Array must contain exactly one element');
        }

        return $arr[0];
    }
}
