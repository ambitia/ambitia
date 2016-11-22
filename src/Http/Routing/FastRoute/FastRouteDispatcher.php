<?php namespace Ambitia\Http\Routing\FastRoute;

use Ambitia\Http\Routing\Contracts\DispatcherContract;
use Ambitia\Http\Routing\Contracts\DispatcherResult;
use Ambitia\Http\Routing\Contracts\RouteContract;
use FastRoute\RouteCollector;

class FastRouteDispatcher implements DispatcherContract
{

    /**
     * @var array
     */
    protected $routes = [];

    /**
     * @var array
     */
    protected $patterns = [];

    /**
     * @inheritDoc
     */
    public function dispatch(string $method, string $uri) : DispatcherResult
    {
        $dispatcher = \FastRoute\simpleDispatcher(function (RouteCollector $r) {
            /** @var RouteContract $route */
            foreach ($this->routes as $route) {
                $r->addRoute(
                    $route->getMethod(),
                    $this->translateUri($route->getUri()),
                    $route->getCallback()
                );
            }
        });

        $routeInfo = $dispatcher->dispatch($method, $uri);

        if (!isset($routeInfo[1]) || !is_callable($routeInfo[1])) {
            $routeInfo[1] = null;
        }

        if (empty($routeInfo[2])) {
            $routeInfo[2] = [];
        }

        return new FastRouteInfo($routeInfo[0], $method, $routeInfo[1], $routeInfo[2]);
    }

    /**
     * Translate internal uri format to external library format
     * @param string $uri
     * @return string
     */
    protected function translateUri(string $uri)
    {
        $uri = $this->stripFirstSlash($uri);

        $parts = explode('/', $uri);

        if (empty($parts)) {
            return '/';
        }

        $uri = '';
        foreach ($parts as $key => &$part) {
            if ($key === 0) {
                $uri .= $part;
                continue;
            }
            if (strpos($part, '{') > -1 && strpos($part, '}') > -1) {
                $uri = $this->addParamAndPatternToUri($uri, $part);
                continue;
            }

            $uri .= sprintf('/%s', $part);
        }

        return $uri;
    }

    /**
     * Strip first slash from uri to normalize it
     * @param string $uri
     * @return string
     */
    protected function stripFirstSlash(string $uri) : string
    {
        if (strpos('/', $uri) === 0) {
            $uri = substr($uri, 1);
        }

        return $uri;
    }

    /**
     * Add parameter and it's pattern to uri based on required format by used library
     * @param string $uri
     * @param string $part
     * @return string
     */
    protected function addParamAndPatternToUri(string $uri, string $part) : string
    {
        $param = str_replace(['{', '}', '?'], '', $part);
        $pattern = !empty($this->patterns[$param]) ? sprintf(':%s', $this->patterns[$param]) : '';
        if (strpos($part, '?')) {
            $uri .= sprintf('[/{%s%s}]', $param, $pattern);
        } else {
            $uri .= sprintf('/{%s%s}', $param, $pattern);
        }

        return $uri;
    }

    /**
     * @inheritDoc
     */
    public function setPatterns(array $patterns)
    {
        $this->patterns = $patterns;
    }

    /**
     * @inheritDoc
     */
    public function setRoutes(array $routes)
    {
        $this->routes = $routes;
    }
}