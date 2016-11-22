<?php

namespace spec\Ambitia\Validation\Rules;

use Ambitia\Contracts\RuleValidator;
use Ambitia\Validation\Rules\Email;
use PhpSpec\ObjectBehavior;

class EmailSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Email::class);
        $this->shouldImplement(RuleValidator::class);
    }

    function it_should_pass_on_valid_email()
    {
        $this->validate('test@test.com')->shouldReturn(true);
        $this->validate('TEST@TEST.COM')->shouldReturn(true);
    }

    function it_should_fail_on_invalid_email()
    {
        $this->validate('@test.com')->shouldReturn(false);
        $this->validate('test.com')->shouldReturn(false);
    }
}
