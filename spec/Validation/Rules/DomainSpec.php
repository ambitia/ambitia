<?php

namespace spec\Ambitia\Validation\Rules;

use Ambitia\Contracts\RuleValidator;
use Ambitia\Validation\Rules\Domain;
use PhpSpec\ObjectBehavior;

class DomainSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Domain::class);
        $this->shouldImplement(RuleValidator::class);
    }

    function it_should_pass_on_valid_domain()
    {
        $this->validate('domain.com')->shouldReturn(true);
        $this->validate('sub.domain.com')->shouldReturn(true);
    }

    function it_should_fail_on_invalid_domain()
    {
        $this->validate('localhost')->shouldReturn(false);
        $this->validate('127.0.0.1')->shouldReturn(false);
        $this->validate('fawfwafaw.fawfadwawd')->shouldReturn(false);
        $this->validate('domain')->shouldReturn(false);
    }

}
