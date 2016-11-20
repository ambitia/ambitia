<?php namespace Ambitia\Http\Routing;

use Ambitia\Http\Routing\Contracts\DispatcherResult;

class RouteInfo implements DispatcherResult
{
    protected $status;

    protected $handler;

    protected $params;

    protected $method;

    /**
     * @inheritDoc
     */
    public function __construct(int $status, string $method, array $handler = null, array $params = [])
    {
        $this->status = $status;
        $this->method = $method;
        $this->handler = $handler;
        $this->params = $params;
    }

    /**
     * @inheritDoc
     */
    function getStatus() : int
    {
        return $this->status;
    }

    /**
     * @inheritDoc
     */
    function getHandler() : array
    {
        return $this->handler;
    }

    /**
     * @inheritDoc
     */
    function getParams() : array
    {
        return $this->params;
    }

    /**
     * @inheritDoc
     */
    function getMethod() : string
    {
        return $this->method;
    }

    /**
     * @inheritDoc
     */
    function setStatus(int $status)
    {
        $this->status = $status;
    }
}