<?php namespace Ambitia\Http\Routing\FastRoute;

use Ambitia\Http\Routing\RouteInfo;
use FastRoute\Dispatcher;

class FastRouteInfo extends RouteInfo
{
    public function __construct(int $status, string $method, array $handler = null, array $params = [])
    {
        parent::__construct($this->mapStatus($status), $method, $handler, $params);
    }

    /**
     * Map FastRoute result status to one of the internal statuses to make
     * the system independent
     * @param mixed $status
     * @return int
     */
    protected function mapStatus($status) : int
    {
        switch ($status) {
            case Dispatcher::METHOD_NOT_ALLOWED:
                return self::METHOD_NOT_ALLOWED;
            case Dispatcher::FOUND:
                return self::FOUND;
            case Dispatcher::NOT_FOUND:
            default:
                return self::NOT_FOUND;
        }
    }

    public function setStatus(int $status)
    {
        $this->status = $this->mapStatus($status);
    }
}
