<?php


namespace App\Http\Controller\Rest;

use App\Http\Annotation\AdminAccess\AdminAccess;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route as ControllerRoute;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Serializer\Encoder\DecoderInterface;

/** @Route("/rest/batch") */
class BatchController extends AbstractController
{
    private $urlMatcher;

    public function __construct(UrlMatcherInterface $urlMatcher)
    {
        $this->urlMatcher = $urlMatcher;
    }

    /**
     * @Route("/", methods={"POST"})
     * @AdminAccess()
     */
    public function __invoke(
        Request $request,
        DecoderInterface $decoder
    ): Response {
        $requests = array_map(
            function (string $path): array {
                return [
                    'route' => $this->getRouteByPath($path),
                    'query' => $this->getQueryByPath($path),
                ];
            },
            $decoder->decode($request->getContent(), 'json')
        );

        $content = [];
        while (count($requests) > 0) {
            $request = array_shift($requests);

            $response = $this->forward(
                $request['route']['_controller'],
                $request['route'],
                $request['query']
            );

            if ($response->isRedirect()) {
                $url = parse_url($response->headers->get('location'));

                $requests[] = [
                    'route' => $this->getRouteByPath($url['path']),
                    'query' => $request['query'],
                ];

                continue;
            }

            if (!$response->isSuccessful()) {
                throw new HttpException(
                    $response->getStatusCode(),
                    'One or more sub-requests failed'
                );
            }

            $content[] = $decoder->decode($response->getContent(), 'json');
        }

        return new JsonResponse($content);
    }

    private function getRouteByPath(string $path): array
    {
        try {
            // set raw context with GET method
            $this->urlMatcher->setContext(new RequestContext());

            // remove query string from url
            $path = strstr($path, '?', true) ?: $path;

            return $this->urlMatcher->match($path);
        } catch (ResourceNotFoundException $e) {
            throw new NotFoundHttpException("Route '{$path}' not found");
        }
    }

    private function getQueryByPath(string $path): array
    {
        try {
            $queryPairs = explode('&', parse_url($path)['query']);
            $parameters = [];
            foreach ($queryPairs as $queryPair) {
                $keyValue = explode('=', $queryPair);
                $parameters[$keyValue[0]] = $keyValue[1];
            }
        } catch (\Exception $e) {
            $parameters = [];
        }

        return $parameters;
    }
}