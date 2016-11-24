<?php

namespace spec\Ambitia\Validation\Rules;

use Ambitia\Validation\Rules\Required;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RequiredSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Required::class);
    }

    function it_should_fail_on_empty_input()
    {
        $this->validate('')->shouldReturn(false);
        $this->validate(' ')->shouldReturn(false);
        $this->validate(null)->shouldReturn(false);
        $this->validate([])->shouldReturn(false);
        $this->validate("\t\n\r")->shouldReturn(false);
    }

    function it_should_pass_on_non_empty_input()
    {
        $this->validate('a')->shouldReturn(true);
        $this->validate(0)->shouldReturn(true);
        $this->validate(0.0)->shouldReturn(true);
        $this->validate(false)->shouldReturn(true);
        $this->validate([1])->shouldReturn(true);
        $this->validate('\t\n\r')->shouldReturn(true);
        $this->validate([[]])->shouldReturn(true);
    }

}
