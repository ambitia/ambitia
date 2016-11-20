<?php

namespace Ambitia\Input\Http\Contracts;


interface HttpRequest
{
    /**
     * Return url without domain and query
     * @return string
     */
    function getPathInfo() : string;

    /**
     * @return string
     */
    function getMethod() : string;
}