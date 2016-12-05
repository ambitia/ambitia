<?php namespace Ambitia\Example\Test;


use Ambitia\Console\Command;
use Ambitia\Interfaces\Console\RequestInterface;
use Ambitia\Interfaces\Console\ResponseInterface;

class TestCommand extends Command
{
    protected $name = 'test';

    protected $description = 'Command used in tests';

    /**
     * @inheritDoc
     */
    public function execute(RequestInterface $request, ResponseInterface $response)
    {
        $response->output('Test success!');
    }
}