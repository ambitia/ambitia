<?php

namespace Ambitia\Contracts\Console;

interface ConsoleContract
{
    /**
     * Set the name of the command. It will be used in console to run it.
     * @param string $name
     * @return $this
     */
    public function setName(string $name);

    /**
     * Set the description for console command to be displayed on the list of available
     * commands
     * @param string $name
     * @return $this
     */
    public function setDescription(string $name);

    /**
     * Description of how to use the command. It will be displayed on running the command with
     * --help flag
     * @param string $help
     * @return $this
     */
    public function setHelp(string $help);

    /**
     * @return void
     */
    public function run();
}