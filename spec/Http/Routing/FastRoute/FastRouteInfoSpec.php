<?php

namespace spec\Ambitia\Http\Routing\FastRoute;

use Ambitia\Http\Routing\Contracts\DispatcherResult;
use Ambitia\Http\Routing\FastRoute\FastRouteInfo;
use FastRoute\Dispatcher;
use PhpSpec\ObjectBehavior;

class FastRouteInfoSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(DispatcherResult::FOUND, 'GET', [IndexEntry::class, 'index'], ['user' => 'World']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(FastRouteInfo::class);
    }

    function it_should_map_external_status_to_system_status()
    {
        $this->beConstructedWith(Dispatcher::FOUND, 'POST', [IndexEntry::class, 'index']);
        $this->getStatus()->shouldReturn(DispatcherResult::FOUND);
        $this->setStatus(Dispatcher::NOT_FOUND);
        $this->getStatus()->shouldReturn(DispatcherResult::NOT_FOUND);
        $this->setStatus(Dispatcher::METHOD_NOT_ALLOWED);
        $this->getStatus()->shouldReturn(DispatcherResult::METHOD_NOT_ALLOWED);
    }
}
