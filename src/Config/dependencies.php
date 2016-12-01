<?php

$dependencies = [
    \Ambitia\Interfaces\Input\HttpRequestInterface::class => \Ambitia\Http\Input\Symfony\Request::class,
    \Ambitia\Interfaces\Routing\RouteMatcherInterface::class => \Ambitia\Http\Routing\MatchRoute::class,
    \Ambitia\Interfaces\Output\ResponseInterface::class => \Ambitia\Http\Output\Response::class,
    \Ambitia\Interfaces\Routing\DispatcherInterface::class => \Ambitia\Http\Routing\FastRoute\FastRouteDispatcher::class,
    \Ambitia\Interfaces\Routing\RouterInterface::class => \Ambitia\Http\Routing\Router::class
];

foreach ($dependencies as &$dependency) {
    $dependency = DI\object($dependency);
}

return $dependencies;
