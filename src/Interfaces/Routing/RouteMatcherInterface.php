<?php

namespace Ambitia\Interfaces\Routing;

use Ambitia\Http\Routing\Exceptions\ClassNotFound;
use Ambitia\Http\Routing\Exceptions\HttpMethodNotAllowed;
use Ambitia\Http\Routing\Exceptions\HttpNotFound;
use Ambitia\Http\Routing\Exceptions\MethodNotFound;
use Ambitia\Interfaces\Output\ResponseInterface;

interface RouteMatcherInterface
{
    /**
     * Match http route to handler callback or throw exception
     * @param DispatcherResultInterface $routeInfo
     * @param ResponseInterface $response
     * @throws HttpMethodNotAllowed
     * @throws HttpNotFound
     * @throws ClassNotFound
     * @throws MethodNotFound
     * @return ResponseInterface
     */
    function match(DispatcherResultInterface $routeInfo, ResponseInterface $response) : ResponseInterface;

}