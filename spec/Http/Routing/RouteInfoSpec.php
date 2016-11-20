<?php

namespace spec\Ambitia\Http\Routing;

use Ambitia\Http\Routing\RouteInfo;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RouteInfoSpec extends ObjectBehavior
{

    function let()
    {
        $meth = [IndexEntry::class, 'index'];
        $this->beConstructedWith(0, 'POST', $meth, []);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(RouteInfo::class);
    }

    function it_should_hold_and_return_data()
    {
        $meth = [IndexEntry::class, 'index'];
        $this->getStatus()->shouldReturn(0);
        $this->getMethod()->shouldReturn('POST');
        $this->getHandler()->shouldReturn($meth);
    }

}
