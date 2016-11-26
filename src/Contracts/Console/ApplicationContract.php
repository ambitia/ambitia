<?php

namespace Ambitia\Contracts\Console;


interface ApplicationContract
{
    /**
     * Bootstrap the console application
     * @return void
     */
    public function run();

    /**
     * Add console command to the available commands
     * @param ConsoleContract $command
     * @return void
     */
    public function add(ConsoleContract $command);
}