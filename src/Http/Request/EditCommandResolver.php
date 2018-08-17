<?php

namespace App\Http\Request;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\SerializerInterface;
use App\Command\EditCommand;

class EditCommandResolver implements ArgumentValueResolverInterface
{
    /** @var SerializerInterface */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        return is_subclass_of($argument->getType(), EditCommand::class);
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        yield $this->serializer->deserialize(
            $request->getContent(),
            $argument->getType(),
            'json',
            [
                'default_constructor_arguments' => [
                    $argument->getType() => ['id' => $request->get('id')],
                ],
            ]
        );
    }
}
