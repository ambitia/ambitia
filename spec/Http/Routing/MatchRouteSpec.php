<?php

namespace spec\Ambitia\Http\Routing;

use Ambitia\Example\Test\IndexEntry;
use Ambitia\Contracts\Routing\DispatcherResultContract;
use Ambitia\Http\Routing\Exceptions\ClassNotFound;
use Ambitia\Http\Routing\Exceptions\HttpMethodNotAllowed;
use Ambitia\Http\Routing\Exceptions\HttpNotFound;
use Ambitia\Http\Routing\Exceptions\MethodNotFound;
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
        $routeInfo = new FastRouteInfo(DispatcherResultContract::NOT_FOUND, 'GET', $callback, ['user' => 'World']);
        $this->shouldThrow(new HttpNotFound())->duringMatch($routeInfo, new Response());
    }

    function it_should_throw_method_not_allowed()
    {
        $callback = [IndexEntry::class, 'index'];
        $routeInfo = new FastRouteInfo(DispatcherResultContract::METHOD_NOT_ALLOWED, 'POST', $callback, ['user' => 'World']);
        $this->shouldThrow(new HttpMethodNotAllowed('POST'))->duringMatch($routeInfo, new Response());
    }

    function it_should_throw_class_doesnt_exist()
    {
        $callback = ['SomeNonExistantClass', 'index'];
        $routeInfo = new FastRouteInfo(DispatcherResultContract::FOUND, 'GET', $callback, ['user' => 'World']);
        $this->shouldThrow(new ClassNotFound('SomeNonExistantClass'))->duringMatch($routeInfo, new Response());
    }

    function it_should_throwmethod_doesnt_exist()
    {
        $callback = [IndexEntry::class, 'someNonExistantMethod'];
        $routeInfo = new FastRouteInfo(DispatcherResultContract::FOUND, 'GET', $callback, ['user' => 'World']);
        $this->shouldThrow(new MethodNotFound(IndexEntry::class, 'someNonExistantMethod'))->duringMatch($routeInfo, new Response());
    }
}
