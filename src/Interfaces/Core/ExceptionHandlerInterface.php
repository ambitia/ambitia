<?php namespace Ambitia\Interfaces\Core;


interface ExceptionHandlerInterface
{
    /**
     * Output the exceptions to CLI
     */
    const OUTPUT_CONSOLE = 1;

    /**
     * Output the exceptions to website
     */
    const OUTPUT_WEB = 2;

    /**
     * Output the exceptions to logger
     */
    const OUTPUT_LOGGER = 3;

    /**
     * Register the global exception handler for console output. Pass an array
     * to register multiple handlers.
     *
     * @param int|array $output
     * @return void
     */
    public function register($output);

}