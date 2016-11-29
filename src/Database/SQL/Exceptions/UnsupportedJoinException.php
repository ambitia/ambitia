<?php namespace Ambitia\Database\SQL\Exceptions;


use Exception;

class UnsupportedJoinException extends \Exception
{
    public function __construct(Exception $previous = null)
    {
        $message = 'Cross and full join is not supported by doctrine query builder';

        parent::__construct($message, 500, $previous);
    }
}