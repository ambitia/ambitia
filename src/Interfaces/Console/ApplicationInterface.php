<?php

namespace Ambitia\Interfaces\Console;


interface ApplicationInterface
{
    /**
     * Bootstrap the console application
     * @return void
     */
    public function run();

    /**
     * Add console command to the available commands
     * @param ConsoleInterface $command
     * @return void
     */
    public function add(ConsoleInterface $command);
}