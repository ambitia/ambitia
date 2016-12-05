<?php

namespace spec\Ambitia\Console\CLimate;

use Ambitia\Console\CLimate\Request;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RequestSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(['ambitia.php', 'help']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Request::class);
    }
}
