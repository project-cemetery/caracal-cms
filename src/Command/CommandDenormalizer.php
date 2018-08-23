<?php

namespace App\Command;

use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

/** @psalm-suppress PropertyNotSetInConstructor */
class CommandDenormalizer extends Denormalizer
{
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $reflector = new \ReflectionClass($class);

        $overwriteData = $context['default_constructor_arguments'][$class];
        foreach ($overwriteData as $key => $value) {
            $data[$key] = $value;
        }

        $allowedAttributes = $this->getAllowedAttributes($class, $context);

        return $this->instantiateObject($data, $class, $context, $reflector, $allowedAttributes);
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return is_subclass_of($type, Command::class);
    }
}
