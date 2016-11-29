<?php namespace Ambitia\Database\SQL\Exceptions;


use Exception;

class InvalidJoinException extends \Exception
{
    public function __construct(Exception $previous = null)
    {
        $message = 'From clause is required before you add join in query builder';

        parent::__construct($message, 500, $previous);
    }
}