<?php

namespace App\Http\Request;

use App\Command\DeleteCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class DeleteCommandResolver implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument)
    {
        return is_subclass_of($argument->getType(), DeleteCommand::class);
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        $class = $argument->getType();

        yield new $class($request->get('id'));
    }
}
