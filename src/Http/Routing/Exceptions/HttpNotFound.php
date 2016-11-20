<?php namespace Ambitia\Http\Routing\Exceptions;


class HttpNotFound extends \Exception
{
    public function __construct(\Exception $previous = null)
    {
        parent::__construct('Route not found', 404, $previous);
    }
}