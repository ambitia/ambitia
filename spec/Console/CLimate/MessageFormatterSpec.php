<?php

namespace spec\Ambitia\Console\CLimate;

use Ambitia\Console\CLimate\MessageFormatter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MessageFormatterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(MessageFormatter::class);
    }
}
