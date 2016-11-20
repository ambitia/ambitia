<?php namespace Ambitia\Http\Routing;

use Ambitia\Http\Routing\Contracts\RouteContract;

class Route implements RouteContract
{
    /**
     * HTTP method
     * @var string
     */
    protected $method;
    /**
     * Route name
     * @var string
     */
    protected $name;
    /**
     * Uri path with no query part
     * @var string
     */
    protected $uri;
    /**
     * Callback for when the route is matched
     * @var callable
     */
    protected $callback;

    /**
     * Route constructor.
     * @param string $method
     * @param string $name
     * @param string $uri
     * @param array $callback
     */
    function __construct(string $method, string $name, string $uri, array $callback)
    {
        $this->method = $method;
        $this->name = $name;
        $this->uri = $uri;
        $this->callback = $callback;
    }

    /**
     * @return string
     */
    function getMethod() : string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    function getName() : string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    function getUri() : string
    {
        return $this->uri;
    }

    /**
     * @return array
     */
    function getCallback() : array
    {
        return $this->callback;
    }
}