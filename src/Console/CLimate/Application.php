<?php namespace Ambitia\Console\CLimate;

use Ambitia\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    public function registerCommand(string $command)
    {
        return parent::registerCommand($command);
    }
}