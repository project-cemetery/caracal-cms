<?php

namespace App\Command;

use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

abstract class Denormalizer extends AbstractNormalizer
{
    public function normalize($object, $format = null, array $context = [])
    {
        throw new NotImplementedException("It's denormalizer, normalization not implemented");
    }

    public function supportsNormalization($data, $format = null)
    {
        return false;
    }
}
