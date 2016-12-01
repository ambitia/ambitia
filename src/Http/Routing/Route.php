<?php namespace Ambitia\Http\Routing;

use Ambitia\Interfaces\Routing\RouteInterface;

class Route implements RouteInterface
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
    public function __construct(string $method, string $name, string $uri, array $callback)
    {
        $this->method = $method;
        $this->name = $name;
        $this->uri = $uri;
        $this->callback = $callback;
    }

    /**
     * @return string
     */
    public function getMethod() : string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getUri() : string
    {
        return $this->uri;
    }

    /**
     * @return array
     */
    public function getCallback() : array
    {
        return $this->callback;
    }
}