<?php namespace Ambitia\Example\Test;

use Ambitia\Console\Arguments\TestArgument;
use Ambitia\Console\Command;
use Ambitia\Interfaces\Console\RequestInterface;
use Ambitia\Interfaces\Console\ResponseInterface;

class TestCommand extends Command
{
    public function setup()
    {
        $this->setDescription('Command used in tests')
            ->setArguments([
                TestArgument::class
            ]);
    }

    /**
     * @inheritDoc
     */
    public function execute(RequestInterface $request, ResponseInterface $response)
    {
        throw new \Exception('success');
    }
}