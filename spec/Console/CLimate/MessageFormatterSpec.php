<?php

namespace spec\Ambitia\Console\CLimate;

use Ambitia\Console\CLimate\MessageFormatter;
use League\CLImate\CLImate;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MessageFormatterSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new CLImate());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(MessageFormatter::class);
    }
}
