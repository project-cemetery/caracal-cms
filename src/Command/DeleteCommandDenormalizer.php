<?php


namespace App\Command;

/** @psalm-suppress PropertyNotSetInConstructor */
class DeleteCommandDenormalizer extends Denormalizer
{
    public function denormalize($data, $class, $format = null, array $context = []): DeleteCommand
    {
        $reflector = new \ReflectionClass($class);

        $id = $context['default_constructor_arguments'][$class]['id'];
        $actualData = ['id' => $id];

        $allowedAttributes = $this->getAllowedAttributes($class, $context);

        return $this->instantiateObject($actualData, $class, $context, $reflector, $allowedAttributes);
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return is_subclass_of($type, DeleteCommand::class);
    }
}