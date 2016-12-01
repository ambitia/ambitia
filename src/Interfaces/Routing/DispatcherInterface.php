<?php namespace Ambitia\Interfaces\Routing;


interface DispatcherInterface
{
    /**
     * @param \Ambitia\Interfaces\Routing\RouteInterface[] $routes
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
     * @return DispatcherResultInterface
     */
    function dispatch(string $method, string $uri) : DispatcherResultInterface;
}