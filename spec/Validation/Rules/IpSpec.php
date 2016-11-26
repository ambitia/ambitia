<?php

namespace spec\Ambitia\Validation\Rules;

use Ambitia\Contracts\Validation\RuleContract;
use Ambitia\Validation\Rules\Ip;
use PhpSpec\ObjectBehavior;

class IpSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Ip::class);
        $this->shouldImplement(RuleContract::class);
    }

    function it_should_pass_on_valid_ip()
    {
        $this->validate('127.0.0.1')->shouldReturn(true);
        $this->validate('192.120.10.16')->shouldReturn(true);
        $this->validate('0.0.0.0')->shouldReturn(true);
    }

    function it_should_fail_on_invalid_ip()
    {
        $this->validate('localhost')->shouldReturn(false);
        $this->validate('domain.com')->shouldReturn(false);
        $this->validate('256.256.256.256')->shouldReturn(false);
        $this->validate('0.0.0.0.0')->shouldReturn(false);
    }

}
