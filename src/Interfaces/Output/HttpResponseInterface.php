<?php

namespace Ambitia\Interfaces\Output;

interface HttpResponseInterface extends ResponseInterface
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
     * @return HttpResponseInterface
     */
    function setCode(int $code) : HttpResponseInterface;

    /**
     * @param array $headers
     * @return HttpResponseInterface
     */
    function setHeaders(array $headers) : HttpResponseInterface;

    /**
     * Set a header value for a specific key, with possibility of not overwriting it
     * when the key already exists.
     * @param string $key
     * @param string $value
     * @param bool $replace
     * @return HttpResponseInterface
     */
    function setHeader(string $key, string $value, bool $replace = true) : HttpResponseInterface;

    /**
     * Add a cookie to te response
     * @param \Ambitia\Interfaces\Output\CookieInterface $cookie
     * @return HttpResponseInterface
     */
    function addCookie(CookieInterface $cookie) : HttpResponseInterface;
}