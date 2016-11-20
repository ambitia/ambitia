<?php namespace Ambitia\Http\Routing;

use Ambitia\Http\Routing\Contracts\DispatcherContract;
use Ambitia\Http\Routing\Contracts\DispatcherResult;
use Ambitia\Http\Routing\Contracts\RouteContract;
use Ambitia\Http\Routing\Contracts\RouteMatcher;
use Ambitia\Http\Routing\Contracts\RouterContract;
use Ambitia\Input\Http\Contracts\HttpRequest;
use Ambitia\Output\Contracts\ResponseContract;

class Router implements RouterContract
{
    /**
     * Router dispatcher
     * @var DispatcherContract
     */
    protected $dispatcher;

    /**
     * @var HttpRequest
     */
    protected $request;

    /**
     * @var ResponseContract
     */
    protected $response;

    /**
     * @var RouteMatcher
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
     * @param DispatcherContract $dispatcher
     * @param HttpRequest $request
     * @param RouteMatcher $routeMatcher
     * @param ResponseContract $response
     */
    public function __construct(DispatcherContract $dispatcher, HttpRequest $request,
                                RouteMatcher $routeMatcher, ResponseContract $response)
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
     * @return DispatcherResult
     */
    public function dispatch(string $method, string $uri) : DispatcherResult
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
     * @return RouteContract
     */
    public function getRoute(string $name) : RouteContract
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