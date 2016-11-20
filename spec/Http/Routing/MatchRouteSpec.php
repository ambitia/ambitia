<?php

namespace spec\Ambitia\Http\Routing;

use Ambitia\Http\Routing\Contracts\DispatcherResult;
use Ambitia\Http\Routing\Exceptions\HttpMethodNotAllowed;
use Ambitia\Http\Routing\Exceptions\HttpNotFound;
use Ambitia\Http\Routing\FastRoute\FastRouteInfo;
use Ambitia\Http\Routing\MatchRoute;
use Ambitia\Output\Response;
use PhpSpec\ObjectBehavior;

class MatchRouteSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(MatchRoute::class);
    }

    function it_should_throw_not_found()
    {
        $callback = [IndexEntry::class, 'index'];
        $routeInfo = new FastRouteInfo(DispatcherResult::NOT_FOUND, 'GET', $callback, ['user' => 'World']);
        $this->shouldThrow(new HttpNotFound())->duringMatch($routeInfo, new Response());
    }

    function it_should_throw_method_not_allowed()
    {
        $callback = [IndexEntry::class, 'index'];
        $routeInfo = new FastRouteInfo(DispatcherResult::METHOD_NOT_ALLOWED, 'POST', $callback, ['user' => 'World']);
        $this->shouldThrow(new HttpMethodNotAllowed('POST'))->duringMatch($routeInfo, new Response());
    }
}
