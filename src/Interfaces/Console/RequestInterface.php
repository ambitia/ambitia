<?php

namespace Ambitia\Interfaces\Console;


interface RequestInterface
{
    /**
     * Get the name of invoked command
     *
     * @return string
     */
    public function getCommandName(): string;

    /**
     * Set command name that should be executed during this request
     *
     * @param string $name
     * @return void
     */
    public function setCommandName(string $name);

    /**
     * Get arguments used on invoked command
     *
     * @return ArgumentInterface[]
     */
    public function getArguments(): array;

    /**
     * Add arguments that are available for the requested command
     *
     * @param string[] $arguments
     * @return void
     */
    public function addPossibleArguments(array $arguments);
}