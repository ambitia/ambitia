<?php namespace Ambitia\Console\Exceptions;

use Exception;

class NoSuchArgumentException extends \Exception
{
    public function __construct(string $prefix, string $console, Exception $previous = null)
    {
        $message = sprintf('No argument with prefix %s found in a %s', $prefix, $console);

        parent::__construct($message, 0, $previous);
    }
}