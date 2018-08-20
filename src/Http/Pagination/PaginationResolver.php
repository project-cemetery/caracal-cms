<?php

namespace App\Http\Pagination;

use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class PaginationResolver implements ArgumentValueResolverInterface
{
    private const DEFAULT_PER_PAGE = 10;

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        return Pagination::class === $argument->getType();
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        yield new Pagination(
            (int) $request->get('page', 1),
            (int) $request->get('perPage', self::DEFAULT_PER_PAGE)
        );
    }
}
