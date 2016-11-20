<?php namespace Ambitia\Http\Routing\Contracts;


interface DispatcherContract
{
    /**
     * @param \Ambitia\Http\Routing\Contracts\RouteContract[] $routes
     * @return void
     */
    function setRoutes(array $routes);

    /**
     * @param array $patterns
     * @return void
     */
    function setPatterns(array $patterns);

    /**
     * @param string $method
     * @param string $uri
     * @return DispatcherResult
     */
    function dispatch(string $method, string $uri) : DispatcherResult;
}