<?php

$map = [
    // Container
    \Ambitia\Interfaces\DIContainer\ContainerInterface::class => \Ambitia\DIContainer\PHPDI\Container::class,

    // HTTP
    \Ambitia\Interfaces\Input\HttpRequestInterface::class => \Ambitia\Http\Input\Symfony\Request::class,
    \Ambitia\Interfaces\Routing\RouteMatcherInterface::class => \Ambitia\Http\Routing\MatchRoute::class,
    \Ambitia\Interfaces\Output\ResponseInterface::class => \Ambitia\Http\Output\Response::class,
    \Ambitia\Interfaces\Routing\DispatcherInterface::class => \Ambitia\Http\Routing\FastRoute\FastRouteDispatcher::class,
    \Ambitia\Interfaces\Routing\RouterInterface::class => \Ambitia\Http\Routing\Router::class,

    // Console
    \Ambitia\Interfaces\Console\ApplicationInterface::class => \Ambitia\Console\Application::class,
    \Ambitia\Interfaces\Console\CommandInterface::class => \Ambitia\Console\Command::class,
    \Ambitia\Interfaces\Console\RequestInterface::class => \Ambitia\Console\CLimate\Request::class,
    \Ambitia\Interfaces\Console\ResponseInterface::class => \Ambitia\Console\CLimate\Response::class,
    \Ambitia\Interfaces\Console\MessageFormatterInterface::class => \Ambitia\Console\CLimate\MessageFormatter::class,

    // Validation
    \Ambitia\Interfaces\Validation\ValidatorInterface::class => Ambitia\Validation\Validator::class,

    // Logger & Debug
    \Ambitia\Interfaces\Core\ExceptionHandlerInterface::class => \Ambitia\Core\Whoops\ExceptionHandler::class,
    \Psr\Log\LoggerInterface::class => \Monolog\Logger::class,
];

$properties = [
    \Ambitia\Console\CLimate\Request::class => ['arguments' => !empty($argv) ? $argv : []],
    \Monolog\Logger::class => ['name' => 'logger', [new \Monolog\Handler\StreamHandler()]]
];

return compact('map', 'properties');
