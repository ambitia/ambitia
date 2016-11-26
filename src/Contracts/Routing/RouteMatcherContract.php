<?php

namespace Ambitia\Contracts\Routing;

use Ambitia\Http\Routing\Exceptions\ClassNotFound;
use Ambitia\Http\Routing\Exceptions\HttpMethodNotAllowed;
use Ambitia\Http\Routing\Exceptions\HttpNotFound;
use Ambitia\Http\Routing\Exceptions\MethodNotFound;
use Ambitia\Contracts\Output\ResponseContract;

interface RouteMatcherContract
{
    /**
     * Match http route to handler callback or throw exception
     * @param DispatcherResultContract $routeInfo
     * @param ResponseContract $response
     * @throws HttpMethodNotAllowed
     * @throws HttpNotFound
     * @throws ClassNotFound
     * @throws MethodNotFound
     * @return ResponseContract
     */
    function match(DispatcherResultContract $routeInfo, ResponseContract $response) : ResponseContract;

}