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
     * Get arguments used on invoked command
     *
     * @return ArgumentInterface[]
     */
    public function getArguments(): array;

}