<?php namespace Ambitia\Http\Routing\Exceptions;


class MethodNotFound extends \Exception
{
    public function __construct($className, $methodName, \Exception $previous = null)
    {
        $message = sprintf('Class of name %s doesn\'t have method %s', $className, $methodName);

        parent::__construct($message, 500, $previous);
    }
}
