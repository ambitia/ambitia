<?php namespace Ambitia\Console\Commands;

use Ambitia\Console\Command;
use Ambitia\Interfaces\Console\NoSuchArgumentException;
use Ambitia\Interfaces\Console\RequestInterface;
use Ambitia\Interfaces\Console\ResponseInterface;

class HelpCommand extends Command
{
    protected $name = 'help';

    protected $description = 'Help command explaining how the application works';
    /**
     * @inheritDoc
     */
    public function execute(RequestInterface $request, ResponseInterface $response)
    {
        $response->output('Success!');
    }
}