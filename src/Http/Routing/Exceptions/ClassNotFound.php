<?php namespace Ambitia\Http\Routing\Exceptions;


class ClassNotFound extends \Exception
{
    public function __construct($className, \Exception $previous = null)
    {
        $message = sprintf('Class of name %s doesn\'t exist', $className);

        parent::__construct($message, 500, $previous);
    }
}
