<?php

namespace Ambitia\Interfaces\Routing;


interface DispatcherResultInterface
{
    const NOT_FOUND = 0;

    const FOUND = 1;

    const METHOD_NOT_ALLOWED = 2;

    /**
     * DispatcherResult constructor.
     * @param int $status
     * @param string $method
     * @param array $handler
     * @param array $params
     */
    function __construct(int $status, string $method, array $handler, array $params = []);

    /**
     * @return int
     */
    function getStatus() : int;

    /**
     * @param int $status
     * @return void
     */
    function setStatus(int $status);

    /**
     * @return array
     */
    function getHandler() : array;

    /**
     * @return array
     */
    function getParams() : array;

    /**
     * @return string
     */
    function getMethod() : string;
}