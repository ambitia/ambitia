<?php namespace Ambitia\Console\Exceptions;

use Exception;

class NoSuchCommandException extends \Exception
{
    public function __construct(string $commandName, Exception $previous = null)
    {
        $message = sprintf('There is no %s command registered in the application', $commandName);

        parent::__construct($message, 0, $previous);
    }
}