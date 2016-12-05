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
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var ArgumentInterface[]
     */
    protected $arguments = [];

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
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

        throw new NoSuchArgumentException($prefix, $this->name);
    }

    /**
     * @inheritdoc
     */
    abstract public function execute(RequestInterface $request, ResponseInterface $response);
}