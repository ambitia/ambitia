<?php

namespace spec\Ambitia\Http\Routing\FastRoute;

use Ambitia\Http\Routing\Contracts\DispatcherResult;
use Ambitia\Http\Routing\FastRoute\FastRouteDispatcher;
use Ambitia\Http\Routing\Route;
use PhpSpec\ObjectBehavior;
use Ambitia\Example\Test\IndexEntry;

class FastRouteDispatcherSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FastRouteDispatcher::class);
    }

    function it_should_match_system_uri_to_external_uri()
    {
        $this->setRoutes([
            new Route('POST', 'user.new', 'user/{user?}', [IndexEntry::class, 'index']),
            new Route('DELETE', 'user.new', 'user/super/{user?}', [IndexEntry::class, 'index'])
        ]);
        $routeInfo = $this->dispatch('POST', 'user');
        $routeInfo->shouldImplement(DispatcherResult::class);
        $routeInfo->getStatus()->shouldReturn(DispatcherResult::FOUND);

        $routeInfo = $this->dispatch('POST', 'user/1');
        $routeInfo->getStatus()->shouldReturn(DispatcherResult::FOUND);

        $routeInfo = $this->dispatch('DELETE', 'user/super/1');
        $routeInfo->getStatus()->shouldReturn(DispatcherResult::FOUND);
    }

    function it_should_work_when_cant_match()
    {
        $this->setRoutes([
            new Route('POST', 'user.new', 'user/{user?}', [IndexEntry::class, 'index'])
        ]);
        $routeInfo = $this->dispatch('GET', 'user');
        $routeInfo->getStatus()->shouldReturn(DispatcherResult::METHOD_NOT_ALLOWED);

        $routeInfo = $this->dispatch('POST', 'work');
        $routeInfo->getStatus()->shouldReturn(DispatcherResult::NOT_FOUND);
    }

    function it_should_default_to_slash_when_empty()
    {
        $this->setRoutes([
            new Route('GET', 'user.new', '', [IndexEntry::class, 'index'])
        ]);
        $routeInfo = $this->dispatch('GET', '');
        $routeInfo->getStatus()->shouldReturn(DispatcherResult::FOUND);

        $this->setRoutes([
            new Route('GET', 'user.a', '/', [IndexEntry::class, 'index'])
        ]);
        $routeInfo = $this->dispatch('GET', '');
        $routeInfo->getStatus()->shouldReturn(DispatcherResult::FOUND);
    }

    function it_should_strip_trailing_slash_for_normalization()
    {
        $this->setRoutes([
            new Route('GET', 'user.new', '/user', [IndexEntry::class, 'index'])
        ]);
        $routeInfo = $this->dispatch('GET', 'user');
        $routeInfo->getStatus()->shouldReturn(DispatcherResult::FOUND);
    }
}
