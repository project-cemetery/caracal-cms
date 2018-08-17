<?php

namespace App\Http\Request;

use App\Editor\EditCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Serializer\Exception\MissingConstructorArgumentsException;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;

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
        try {
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
        } catch (MissingConstructorArgumentsException $e) {
            throw new BadRequestHttpException('Invalid fields in request', $e);
        } catch (NotEncodableValueException $e) {
            throw new BadRequestHttpException('Invalid JSON in request', $e);
        }
    }
}
