<?php namespace Ambitia\Console\Arguments;

use Ambitia\Console\Argument;

class TestArgument extends Argument
{
    public function setup()
    {
        $this->setPrefix('t')
            ->setLongPrefix('test')
            ->setDescription('This is a test argument');
    }
}