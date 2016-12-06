<?php

/**
 * Return array of command class names that should be available
 * for your application. Key is a command alias, it will be executed by the
 * key in this array. For example:
 *
 * php bin/ambitia help
 */

return [
    'help' => \Ambitia\Console\Commands\HelpCommand::class,
    'test' => \Ambitia\Example\Test\TestCommand::class,
];