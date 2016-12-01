<?php

namespace Ambitia\Interfaces\Input;


interface HttpRequestInterface extends RequestInterface
{
    /**
     * Return url without domain and query
     * @return string
     */
    public function getPathInfo() : string;

    /**
     * @return string
     */
    public function getMethod() : string;
}