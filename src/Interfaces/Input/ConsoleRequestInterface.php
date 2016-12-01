<?php

namespace Ambitia\Interfaces\Input;

interface ConsoleRequestInterface extends RequestInterface
{
    /**
     * Get name of the command. It will be used in CLI to execute it.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get all arguments from the input.
     *
     * @return array
     */
    public function getArguments(): array;

    /**
     * Get all options from the input. Options are run like so:
     * --optionName for switches
     * --optionName="somevalue" if the option should have some value other than
     * just on/off
     *
     * @return array
     */
    public function getOptions(): array;
}