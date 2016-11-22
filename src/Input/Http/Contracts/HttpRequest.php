<?php

namespace Ambitia\Input\Http\Contracts;


interface HttpRequest
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