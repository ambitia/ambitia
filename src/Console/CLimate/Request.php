<?php namespace Ambitia\Console\CLimate;

use Ambitia\Interfaces\Console\RequestInterface;
use League\CLImate\CLImate;

class Request implements RequestInterface
{
    protected $commandName;
    protected $arguments;
    protected $climate;

    public function __construct(array $arguments)
    {
        $this->climate = new CLImate();
        $this->parseArguments($arguments);
    }

    /**
     * @inheritDoc
     */
    public function getCommandName(): string
    {
        return $this->commandName;
    }

    /**
     * @inheritDoc
     */
    public function getArguments(): array
    {
        return $this->climate->arguments->all();
    }

    /**
     * @param array $arguments
     */
    protected function parseArguments(array $arguments)
    {
        // unset file name arg
        array_shift($arguments);

        $this->commandName = $arguments[0];
        $this->climate->arguments->parse($arguments);
    }
}