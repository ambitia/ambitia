<?php namespace Ambitia\Interfaces\Console;

use Ambitia\Console\Exceptions\NoSuchArgumentException;

interface CommandInterface
{
    /**
     * Get short description of the command
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Set short description for the command
     *
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description);

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
     * Set available arguments for the console command. Pass in array of class names,
     * for example:
     * [
     *      new Ambitia/Console/Arguments/FirstArgument(),
     *      new Ambitia/Console/Arguments/SecondArgument()
     * ]
     *
     * @param ArgumentInterface[] $arguments
     * @return $this
     */
    public function setArguments(array $arguments);

    /**
     * Set available argument for the console command. Use fully qualified class name,
     * for example: Ambitia/Console/Arguments/TestArgument::class
     *
     * @param ArgumentInterface $argument
     * @return $this
     */
    public function addArgument(ArgumentInterface $argument);

    /**
     * Setup command specifications, it's name, arguments, description etc.
     * It will be executed on object construction.
     *
     * @return void
     */
    public function setup();

    /**
     * Execute the command
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return void
     */
    public function execute(RequestInterface $request, ResponseInterface $response);
}