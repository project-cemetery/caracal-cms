<?php

namespace App\Command;

use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

/** @psalm-suppress PropertyNotSetInConstructor */
class DataCommandDenormalizer extends Denormalizer
{
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $commandReflector = new \ReflectionClass($class);

        $constructorParameters = $commandReflector->getConstructor()->getParameters();

        if (count($constructorParameters) > 0) {
            // throw
        }

        $dataType = array_shift($constructorParameters)->getType()->getName();

        $dataReflector = new \ReflectionClass($dataType);

        $overwriteData = $context['default_constructor_arguments'][$dataType];
        foreach ($overwriteData as $key => $value) {
            $data[$key] = $value;
        }

        $allowedAttributes = $this->getAllowedAttributes($dataType, $context);

        $data = $this->instantiateObject($data, $dataType, $context, $dataReflector, $allowedAttributes);

        return new $class($data);
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return is_subclass_of($type, CreateCommand::class) || is_subclass_of($type, EditCommand::class);
    }
}
