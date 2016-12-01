<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Ambitia\Example\Test\IndexEntry;
use Ambitia\DIContainer\Container;
use Ambitia\Interfaces\Routing\RouterInterface;

$containerConfig = include './Config/dependencies.php';
$container = new Container(new \DI\ContainerBuilder(), $containerConfig);

$router = $container->get(RouterInterface::class);
$router->route('GET', 'index', '/', [IndexEntry::class, 'index']);

$router->run();
