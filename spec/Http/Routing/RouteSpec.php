<?php

namespace spec\Ambitia\Http\Routing;

use Ambitia\Contracts\Routing\RouteContract;
use Ambitia\Http\Routing\Route;
use PhpSpec\ObjectBehavior;
use Ambitia\Example\Test\IndexEntry;

class RouteSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('GET', 'user.index', '/user', [IndexEntry::class, 'index']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Route::class);
    }

    function it_should_be_a_route()
    {
        $this->shouldImplement(RouteContract::class);
    }

    function it_should_be_possible_to_get_back_data()
    {
        $this->getName()->shouldBe('user.index');
        $this->getMethod()->shouldBe('GET');
        $this->getUri()->shouldBe('/user');
        $this->getCallback()->shouldBe([IndexEntry::class, 'index']);
    }
}
