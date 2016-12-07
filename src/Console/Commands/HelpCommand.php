<?php namespace Ambitia\Console\Commands;

use Ambitia\Console\Command;
use Ambitia\Interfaces\Console\Color;
use Ambitia\Interfaces\Console\NoSuchArgumentException;
use Ambitia\Interfaces\Console\RequestInterface;
use Ambitia\Interfaces\Console\ResponseInterface;

class HelpCommand extends Command
{
    public function setup()
    {
        $this->setDescription('Help command explaining how the application works');
    }

    /**
     * @inheritDoc
     */
    public function execute(RequestInterface $request, ResponseInterface $response)
    {
        $response->getFormatter()
            ->color(Color::RED, Color::WHITE)
            ->underline()
            ->bold();
        $response->output('Success!');
    }
}
