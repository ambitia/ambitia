<?php

$dependencies = [
//    \Ambitia\Contracts\Input\HttpRequestContract::class => \Ambitia\Input\Http\Symfony\Request::class,
    \Ambitia\Contracts\Routing\RouteMatcherContract::class => \Ambitia\Http\Routing\MatchRoute::class,
    \Ambitia\Contracts\Output\ResponseContract::class => \Ambitia\Http\Output\Response::class,
    \Ambitia\Contracts\Routing\DispatcherContract::class => \Ambitia\Http\Routing\FastRoute\FastRouteDispatcher::class,
    \Ambitia\Contracts\Routing\RouterContract::class => \Ambitia\Http\Routing\Router::class
];

foreach ($dependencies as &$dependency) {
    $dependency = DI\object($dependency);
}

return $dependencies;
