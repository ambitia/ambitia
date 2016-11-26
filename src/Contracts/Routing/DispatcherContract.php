<?php namespace Ambitia\Contracts\Routing;


interface DispatcherContract
{
    /**
     * @param \Ambitia\Contracts\Routing\RouteContract[] $routes
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
     * @return DispatcherResultContract
     */
    function dispatch(string $method, string $uri) : DispatcherResultContract;
}