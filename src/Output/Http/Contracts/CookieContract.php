<?php

namespace Ambitia\Frame\Connectors;


interface CookieContract
{
    /**
     * Create a new cookie.
     * @param string $name
     * @param string $value
     * @param int $minutes
     * @param string|null $path
     * @param string|null $domain
     * @param bool $secure
     * @param bool $httpOnly
     * @return Cookie
     */
    public function make(string $name, string $value, int $minutes, string $path = null,
                         string $domain = null, bool $secure = false,
                         bool $httpOnly = true) : Cookie;

    /**
     * Expire cookie.
     * @param string $name
     * @param string|null $path
     * @param string|null $domain
     * @return Cookie
     */
    public function forget(string $name, string $path = null, string $domain = null) : Cookie;
}