<?php namespace Ambitia\Database\SQL\Exceptions;

use Exception;

class InvalidOrderDirectionException extends \Exception
{
    public function __construct($direction, Exception $previous = null)
    {
        $message = sprintf('Direction %s is not supported. Choose one of: "ASC" for ascending order or "DESC" for descending order');
        parent::__construct($message, 500, $previous);
    }
}