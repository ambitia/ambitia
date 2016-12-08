<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Ambitia\Example\Test\IndexEntry;
use Ambitia\Interfaces\Routing\RouterInterface;
use Ambitia\Interfaces\DIContainer\ContainerInterface;

define('ROOT_DIR', __DIR__ . '/../');

$containerConfig = include __DIR__ . '/Config/dependencies.php';
$containerClass = $containerConfig['map'][ContainerInterface::class];
/** @var ContainerInterface $container */
$container = new $containerClass($containerConfig);

/** @var RouterInterface $router */
$router = $container->get(RouterInterface::class);
$router->route('GET', 'index', '/', [IndexEntry::class, 'index']);

$router->run();
