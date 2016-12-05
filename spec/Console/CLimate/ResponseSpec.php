<?php

namespace spec\Ambitia\Console\CLimate;

use Ambitia\Console\CLimate\MessageFormatter;
use Ambitia\Console\CLimate\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ResponseSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new MessageFormatter());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Response::class);
    }
}
