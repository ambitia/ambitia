<?php

$dependencies = [
    \Ambitia\Input\Http\Contracts\HttpRequest::class => \Ambitia\Input\Http\Symfony\Request::class,
    \Ambitia\Http\Routing\Contracts\RouteMatcher::class => \Ambitia\Http\Routing\MatchRoute::class,
    \Ambitia\Output\Contracts\ResponseContract::class => \Ambitia\Output\Response::class,
    \Ambitia\Http\Routing\Contracts\DispatcherContract::class => \Ambitia\Http\Routing\FastRoute\FastRouteDispatcher::class,
    \Ambitia\Http\Routing\Contracts\RouterContract::class => \Ambitia\Http\Routing\Router::class
];

foreach ($dependencies as &$dependency) {
    $dependency = DI\object($dependency);
}

return $dependencies;
