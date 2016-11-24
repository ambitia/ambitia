<?php

namespace spec\Ambitia\Validation\Rules;

use Ambitia\Validation\Rules\Regex;
use PhpSpec\ObjectBehavior;

class RegexSpec extends ObjectBehavior
{
    function let()
    {
        $regex = '/[a-z0-9]/';
        $this->beConstructedWith($regex);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Regex::class);
    }

    function it_should_pass_on_matched_regex()
    {
        $this->validate('a0')->shouldReturn(true);
        $this->validate('A!')->shouldReturn(false);
    }
}
