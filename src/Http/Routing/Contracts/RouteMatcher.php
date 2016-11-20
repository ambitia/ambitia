<?php

namespace Ambitia\Http\Routing\Contracts;

use Ambitia\Http\Routing\Exceptions\ClassNotFound;
use Ambitia\Http\Routing\Exceptions\HttpMethodNotAllowed;
use Ambitia\Http\Routing\Exceptions\HttpNotFound;
use Ambitia\Http\Routing\Exceptions\MethodNotFound;
use Ambitia\Output\Contracts\ResponseContract;

interface RouteMatcher
{
    /**
     * Match http route to handler callback or throw exception
     * @param DispatcherResult $routeInfo
     * @param ResponseContract $response
     * @throws HttpMethodNotAllowed
     * @throws HttpNotFound
     * @throws ClassNotFound
     * @throws MethodNotFound
     * @return ResponseContract
     */
    function match(DispatcherResult $routeInfo, ResponseContract $response) : ResponseContract;

}