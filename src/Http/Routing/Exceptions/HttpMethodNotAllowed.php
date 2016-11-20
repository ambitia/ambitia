<?php namespace Ambitia\Http\Routing\Exceptions;


class HttpMethodNotAllowed extends \Exception
{
    public function __construct($method, $code = 405, \Exception $previous = null)
    {
        $message = sprintf('HTTP method %s is not allowed.', $method);
        parent::__construct($message, $code, $previous);
    }
}