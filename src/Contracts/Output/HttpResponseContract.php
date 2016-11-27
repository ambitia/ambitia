<?php

namespace Ambitia\Contracts\Output;

interface HttpResponseContract extends ResponseContract
{
    /**
     * Get status code for http response
     * @return int
     */
    function getCode() : int;

    /**
     * Get headers of the HTTP response
     * @return array
     */
    function getHeaders() : array;

    /**
     * @param int $code
     * @return HttpResponseContract
     */
    function setCode(int $code) : HttpResponseContract;

    /**
     * @param array $headers
     * @return HttpResponseContract
     */
    function setHeaders(array $headers) : HttpResponseContract;

    /**
     * Set a header value for a specific key, with possibility of not overwriting it
     * when the key already exists.
     * @param string $key
     * @param string $value
     * @param bool $replace
     * @return HttpResponseContract
     */
    function setHeader(string $key, string $value, bool $replace = true) : HttpResponseContract;

    /**
     * Add a cookie to te response
     * @param \Ambitia\Contracts\Output\CookieContract $cookie
     * @return HttpResponseContract
     */
    function addCookie(CookieContract $cookie) : HttpResponseContract;
}