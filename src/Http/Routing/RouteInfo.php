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
    public function getStatus() : int
    {
        return $this->status;
    }

    /**
     * @inheritDoc
     */
    public function getHandler() : array
    {
        return $this->handler;
    }

    /**
     * @inheritDoc
     */
    public function getParams() : array
    {
        return $this->params;
    }

    /**
     * @inheritDoc
     */
    public function getMethod() : string
    {
        return $this->method;
    }

    /**
     * @inheritDoc
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }
}