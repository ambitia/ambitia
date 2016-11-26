<?php

namespace Ambitia\Contracts\Routing;

interface RouterContract
{
    /**
     * Add a route to the stack.
     * @param string $method HTTP method
     * @param string $name Route name
     * @param string $path
     * @param string[] $callback [class_name, method_name]
     */
    public function route(string $method, string $name, string $path, array $callback);

    /**
     * Dispatch route dispatcher and match the route
     * @param string $method
     * @param string $uri
     * @return DispatcherResultContract
     */
    public function dispatch(string $method, string $uri) : DispatcherResultContract;

    /**
     * Add parameter patterns to internal storage
     * @param string $param
     * @param string $rule
     */
    public function pattern(string $param, string $rule);

    /**
     * Get route instance by it's name
     * @param string $name
     * @return RouteContract
     */
    public function getRoute(string $name) : RouteContract;

    /**
     * Get pattern by it's name
     * @param string $param
     * @return string
     */
    public function getPattern(string $param);

    /**
     * Start the routing mechanism, pull data from the Request
     * and execute route callback
     * @return void
     */
    public function run();
}