<?php

namespace Ambitia\Contracts\Input;


interface HttpRequestContract extends RequestContract
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