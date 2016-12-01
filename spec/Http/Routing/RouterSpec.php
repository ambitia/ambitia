<?php

namespace spec\Ambitia\Http\Routing;

use Ambitia\Interfaces\Routing\DispatcherResultInterface;
use Ambitia\Interfaces\Routing\RouteInterface;
use Ambitia\Http\Routing\FastRoute\FastRouteDispatcher;
use Ambitia\Http\Routing\MatchRoute;
use Ambitia\Http\Routing\Router;
use Ambitia\Http\Input\Symfony\Request;
use Ambitia\Http\Output\Response;
use PhpSpec\ObjectBehavior;
use Ambitia\Example\Test\IndexEntry;

class RouterSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new FastRouteDispatcher(), new Request(), new MatchRoute(), new Response());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Router::class);
    }

    function it_should_add_new_routes()
    {
        $this->route('GET', 'user.show', 'user/{:user}', [IndexEntry::class, 'index']);
        $this->route('POST', 'user.new', 'user', [IndexEntry::class, 'new']);
        $this->route('PUT', 'user.edit', 'user/{:user}', [IndexEntry::class, 'edit']);
        $this->route('DELETE', 'user.delete', 'user/{:user}', [IndexEntry::class, 'delete']);
        $route = $this->getRoute('user.show');
        $route->shouldBeAnInstanceOf(RouteInterface::class);
        $route->getName()->shouldBe('user.show');
        $route->getMethod()->shouldBe('GET');
        $route->getUri()->shouldBe('user/{:user}');
        $callback = $route->getCallback();
        $callback->shouldBe([IndexEntry::class, 'index']);
    }

    function it_should_add_new_patterns()
    {
        $this->pattern('id', '\d+');
        $this->getPattern('id')->shouldReturn('\d+');
    }

    function it_should_dispatch_router_and_find_route()
    {
        $this->route('GET', 'user.show', '/user/{user}', [IndexEntry::class, 'index']);
        $this->pattern('user', '\d+');
        $dispatch = $this->dispatch('GET', '/user/1');
        $dispatch->shouldBeAnInstanceOf(DispatcherResultInterface::class);
    }

}
