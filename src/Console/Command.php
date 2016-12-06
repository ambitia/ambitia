<?php namespace Ambitia\Console;

use Ambitia\Console\Exceptions\NoSuchArgumentException;
use Ambitia\Interfaces\Console\ArgumentInterface;
use Ambitia\Interfaces\Console\CommandInterface;
use Ambitia\Interfaces\Console\RequestInterface;
use Ambitia\Interfaces\Console\ResponseInterface;

abstract class Command implements CommandInterface
{
    /**
     * @var string
     */
    protected $description;

    /**
     * @var ArgumentInterface[]
     */
    protected $arguments = [];


    public function __construct()
    {
        $this->setup();
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @inheritDoc
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * @inheritdoc
     */
    public function getArgument(string $prefix): ArgumentInterface
    {
        foreach ($this->arguments as $argument) {
            if ($argument->checkPrefix($prefix)) {
                return $argument;
            }
        }

        throw new NoSuchArgumentException($prefix, static::class);
    }

    /**
     * @inheritDoc
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addArgument(ArgumentInterface $argument)
    {
        $this->arguments[] = $argument;

        return $this;
    }

    /**
     * Setup command specifications, it's name, arguments, description etc.
     *
     * @return void
     */
    abstract public function setup();

    /**
     * @inheritdoc
     */
    abstract public function execute(RequestInterface $request, ResponseInterface $response);
}