<?php

namespace Ambitia\Interfaces\Output;

interface ConsoleResponseInterface extends ResponseInterface
{
    /**
     * Write single string message to the output
     *
     * @param string $message Message string to be displayed by the output
     * @param bool $newline Should the message end with a newline
     * @return void
     */
    public function write(string $message, $newline = false);

    /**
     * Write array of string messages to the output, one per line
     *
     * @param string[] $messages Array of string messages that will be displayed one per line
     * @return void
     */
    public function writeln(array $messages);

}