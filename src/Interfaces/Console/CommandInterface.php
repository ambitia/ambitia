<?php namespace Ambitia\Interfaces\Console;

interface CommandInterface
{
    /**
     * get the name of console command.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Set short description of the command
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Get one of the available arguments for console command by it's name.
     * Throws exception when no argument by that prefix is available
     *
     * @param string $prefix
     * @throws NoSuchArgumentException
     * @return ArgumentInterface
     */
    public function getArgument(string $prefix): ArgumentInterface;

    /**
     * Get available arguments for console command
     *
     * @return array
     */
    public function getArguments(): array;

    /**
     * Execute the command
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return void
     */
    public function execute(RequestInterface $request, ResponseInterface $response);
}