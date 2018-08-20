<?php

namespace App\Http\Request;

use App\Command\CreateCommand;
use App\Service\IdGenerator\IdGenerator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\SerializerInterface;

class CreateCommandResolver implements ArgumentValueResolverInterface
{
    /** @var SerializerInterface */
    private $serializer;

    /** @var IdGenerator */
    private $idGenerator;

    public function __construct(SerializerInterface $serializer, IdGenerator $idGenerator)
    {
        $this->serializer = $serializer;
        $this->idGenerator = $idGenerator;
    }

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        return is_subclass_of($argument->getType(), CreateCommand::class);
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        $id = $this->idGenerator->generate();

        yield $this->serializer->deserialize(
            $request->getContent(),
            $argument->getType(),
            'json',
            [
                'default_constructor_arguments' => [
                    $argument->getType() => ['id' => $id],
                ],
            ]
        );
    }
}
