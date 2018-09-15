<?php


namespace App\Http\Controller\Rest;

use App\Http\Annotation\AdminAccess\AdminAccess;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Route as ControllerRoute;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Serializer\Encoder\DecoderInterface;

/** @Route("/rest/batch") */
class BatchController extends AbstractController
{
    /**
     * @Route("/", methods={"POST"})
     * @AdminAccess()
     */
    public function __invoke(
        Request $request,
        DecoderInterface $decoder,
        RouterInterface $router
    ): Response {
        $paths = $decoder->decode($request->getContent(), 'json');

        $contents = array_map(
            function (string $path) use ($router, $decoder): array {
                $controller = $this->getRouteByPath($router, $path);

                $response = $this->forward($controller);

                if ($response->getStatusCode() !== Response::HTTP_OK) {
                    throw new \Exception();
                }

                return [$path => $decoder->decode($response->getContent(), 'json')];
            },
            $paths
        );

        return new JsonResponse(array_merge(...$contents));
    }

    private function getRouteByPath(RouterInterface $router, $path): string
    {
        /** @var ControllerRoute|null $route */
        $route = array_find(
            $router->getRouteCollection()->all(),
            function (ControllerRoute $route) use ($path): bool {
                return $route->getPath() === $path;
            }
        );

        if (!$route) {
            throw new \Exception();
        }

        return $route->getDefaults()['_controller'];
    }
}