<?php

namespace spec\Ambitia\Http\Routing\FastRoute;

use Ambitia\Interfaces\Routing\DispatcherResultInterface;
use Ambitia\Http\Routing\FastRoute\FastRouteInfo;
use FastRoute\Dispatcher;
use PhpSpec\ObjectBehavior;
use Ambitia\Example\Test\IndexEntry;

class FastRouteInfoSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(DispatcherResultInterface::FOUND, 'GET', [IndexEntry::class, 'index'], ['user' => 'World']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(FastRouteInfo::class);
    }

    function it_should_map_external_status_to_system_status()
    {
        $this->beConstructedWith(Dispatcher::FOUND, 'POST', [IndexEntry::class, 'index']);
        $this->getStatus()->shouldReturn(DispatcherResultInterface::FOUND);
        $this->setStatus(Dispatcher::NOT_FOUND);
        $this->getStatus()->shouldReturn(DispatcherResultInterface::NOT_FOUND);
        $this->setStatus(Dispatcher::METHOD_NOT_ALLOWED);
        $this->getStatus()->shouldReturn(DispatcherResultInterface::METHOD_NOT_ALLOWED);
    }
}
