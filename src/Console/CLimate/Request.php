<?php namespace Ambitia\Console\CLimate;

use Ambitia\Console\Exceptions\NoSuchCommandException;
use Ambitia\Interfaces\Console\ArgumentInterface;
use Ambitia\Interfaces\Console\RequestInterface;
use League\CLImate\Argument\Argument;
use League\CLImate\CLImate;

class Request implements RequestInterface
{
    /**
     * Name of the invoked command
     * @var string
     */
    protected $commandName;

    /**
     * Array of arguments passed to command
     * @var ArgumentInterface[]
     */
    protected $arguments = [];

    /**
     * Backup arguments array without file name. It's used for parsing by CLImate after
     * command arguments are registered
     * @var array
     */
    protected $argumentsBackup = [];

    /**
     * Instance of CLImate external library
     * @var CLImate
     */
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
        $arguments = $this->climate->arguments->all();
        $return = [];

        /** @var Argument $argument */
        foreach ($arguments as $argument) {
            $class = $argument->name();

            /** @var ArgumentInterface $class */
            $class = new $class();
            $class->setValue($argument->value());
            $return[] = $class;
        }

        return $return;
    }

    /**
     * @param array $arguments
     * @throws NoSuchCommandException
     */
    protected function parseArguments(array $arguments)
    {
        // unset file name argument
        array_shift($arguments);

        if (empty($arguments[0])) {
            throw new NoSuchCommandException('<unspecified>');
        }

        $this->commandName = $arguments[0];
        $this->argumentsBackup = $arguments;
    }

    /**
     * @inheritDoc
     */
    public function setCommandName(string $name)
    {
        $this->commandName = $name;
    }

    /**
     * @inheritDoc
     */
    public function addPossibleArguments(array $arguments)
    {
        $args = [];

        foreach ($arguments as $argument) {
            /** @var ArgumentInterface $argumentObject */
            $argumentObject = new $argument();
            $args[$argument] = $argumentObject->toArray();
        }

        $this->climate->arguments->add($args);
        $this->climate->arguments->parse($this->argumentsBackup);
    }
}
