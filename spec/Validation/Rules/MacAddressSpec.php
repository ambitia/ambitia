<?php

namespace spec\Ambitia\Validation\Rules;

use Ambitia\Contracts\RuleValidator;
use Ambitia\Validation\Rules\MacAddress;
use PhpSpec\ObjectBehavior;

class MacAddressSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(MacAddress::class);
        $this->shouldImplement(RuleValidator::class);
    }

    function it_should_pass_on_valid_mac()
    {
        $this->validate('28-11-85-40-06-27')->shouldReturn(true);
        $this->validate('DF:E8:FA:90:B0:43')->shouldReturn(true);
        $this->validate('4D71.3109.03A3')->shouldReturn(true);
        $this->validate('f318.3fae.ab9f')->shouldReturn(true);
        $this->validate('8c:24:b7:9c:60:0f')->shouldReturn(true);
        $this->validate('e4-62-b8-14-02-22')->shouldReturn(true);
    }

    function it_should_fail_on_invalid_mac()
    {
        $this->validate('8c:24:b7:9c:60')->shouldReturn(false);
        $this->validate('8c-24-b7-9c-60')->shouldReturn(false);
        $this->validate('e4-62-b8-14-02:22')->shouldReturn(false);
        $this->validate('e4-62-b8-14-02-22:22')->shouldReturn(false);
        $this->validate('e4-62-b8-14-02-22-22')->shouldReturn(false);
    }
}
