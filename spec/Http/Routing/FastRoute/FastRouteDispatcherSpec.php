<?php

namespace spec\Ambitia\Http\Routing\FastRoute;

use Ambitia\Http\Routing\Contracts\DispatcherResult;
use Ambitia\Http\Routing\FastRoute\FastRouteDispatcher;
use Ambitia\Http\Routing\Route;
use PhpSpec\ObjectBehavior;

class FastRouteDispatcherSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FastRouteDispatcher::class);
    }

    function it_should_match_system_uri_to_external_uri()
    {
        $this->setRoutes([
            new Route('POST', 'user.new', 'user/{user?}', [IndexEntry::class, 'index'])
        ]);
        $routeInfo = $this->dispatch('POST', 'user');
        $routeInfo->shouldImplement(DispatcherResult::class);
        $routeInfo->getStatus()->shouldReturn(DispatcherResult::FOUND);

        $routeInfo = $this->dispatch('POST', 'user/1');
        $routeInfo->getStatus()->shouldReturn(DispatcherResult::FOUND);
    }
}