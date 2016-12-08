<?php

namespace spec\Ambitia\Console\CLimate;

use Ambitia\Console\CLimate\MessageFormatter;
use Ambitia\Console\CLimate\Response;
use League\CLImate\CLImate;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ResponseSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new MessageFormatter(new CLImate()));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Response::class);
    }
}
