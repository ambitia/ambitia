<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Ambitia\Interfaces\DIContainer\ContainerInterface;
use Ambitia\Interfaces\Console\ApplicationInterface;

define('ROOT_DIR', __DIR__);

$containerConfig = include __DIR__ . '/Config/dependencies.php';
$containerClass = $containerConfig['map'][ContainerInterface::class];
/** @var ContainerInterface $container */
$container = new $containerClass($containerConfig);

$commands = include __DIR__ . '/Console/commands.php';
/** @var ApplicationInterface $application */
$application = $container->get(ApplicationInterface::class);
$application->registerCommands($commands);
$application->execute();
