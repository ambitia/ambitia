<?php namespace Ambitia\Http\Routing;

use Ambitia\Interfaces\Routing\DispatcherInterface;
use Ambitia\Interfaces\Routing\DispatcherResultInterface;
use Ambitia\Interfaces\Routing\RouteInterface;
use Ambitia\Interfaces\Routing\RouteMatcherInterface;
use Ambitia\Interfaces\Routing\RouterInterface;
use Ambitia\Interfaces\Input\HttpRequestInterface;
use Ambitia\Interfaces\Output\ResponseInterface;

class Router implements RouterInterface
{
    /**
     * Router dispatcher
     * @var DispatcherInterface
     */
    protected $dispatcher;

    /**
     * @var HttpRequestInterface
     */
    protected $request;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @var RouteMatcherInterface
     */
    protected $routeMatcher;

    /**
     * Routes collection
     * @var array
     */
    protected $routes = [];

    /**
     * Regular expression patterns for route params.
     * @var array
     */
    protected $patterns = [];

    /**
     * Router constructor.
     * @param DispatcherInterface $dispatcher
     * @param HttpRequestInterface $request
     * @param RouteMatcherInterface $routeMatcher
     * @param ResponseInterface $response
     */
    public function __construct(DispatcherInterface $dispatcher, HttpRequestInterface $request,
                                RouteMatcherInterface $routeMatcher, ResponseInterface $response)
    {
        $this->dispatcher = $dispatcher;
        $this->request = $request;
        $this->response = $response;
        $this->routeMatcher = $routeMatcher;
    }

    /**
     * Add a route to the stack.
     * @param string $method HTTP method
     * @param string $name Route name
     * @param string $path
     * @param array $callback
     */
    public function route(string $method, string $name, string $path, array $callback)
    {
        $this->routes[$name] = new Route($method, $name, $path, $callback);
    }

    /**
     * Dispatch route dispatcher and match the route
     * @param string $method
     * @param string $uri
     * @return DispatcherResultInterface
     */
    public function dispatch(string $method, string $uri) : DispatcherResultInterface
    {
        $this->dispatcher->setRoutes($this->routes);
        $this->dispatcher->setPatterns($this->patterns);

        return $this->dispatcher->dispatch($method, $uri);
    }

    /**
     * Add parameter patterns to internal storage
     * @param string $param
     * @param string $rule
     */
    public function pattern(string $param, string $rule)
    {
        $this->patterns[$param] = $rule;
    }

    /**
     * Get route instance by it's name
     * @param string $name
     * @return RouteInterface
     */
    public function getRoute(string $name) : RouteInterface
    {
        return $this->routes[$name];
    }

    /**
     * Get pattern by it's name
     * @param string $param
     * @return string
     */
    public function getPattern(string $param)
    {
        return $this->patterns[$param];
    }

    /**
     * @inheritDoc
     */
    public function run()
    {
        $method = $this->request->getMethod();
        $uri = $this->request->getPathInfo();

        $routeInfo = $this->dispatch($method, $uri);

        $this->routeMatcher->match($routeInfo, $this->response);
    }
}