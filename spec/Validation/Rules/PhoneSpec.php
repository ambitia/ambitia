<?php

namespace spec\Ambitia\Validation\Rules;

use Ambitia\Validation\Rules\Phone;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PhoneSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Phone::class);
    }

    function it_should_pass_on_valid_phone_number()
    {
        $this->validate('(555)555-5555')->shouldReturn(true);
        $this->validate('555 555 5555')->shouldReturn(true);
        $this->validate('+5(555)555.5555')->shouldReturn(true);
        $this->validate('33(1)22 22 22 22')->shouldReturn(true);
        $this->validate('+33(1)22 22 22 22')->shouldReturn(true);
        $this->validate('+33(020)7777 7777')->shouldReturn(true);
        $this->validate('03-6106666')->shouldReturn(true);
    }

    function it_should_faile_on_invalid_phone_number()
    {
        $this->validate('(555)555-5(555)')->shouldReturn(false);
        $this->validate('555 555 (5555)')->shouldReturn(false);
        $this->validate('*5(555)555.5555')->shouldReturn(false);
        $this->validate('33(1)22 22 22 22 22 22 22 22 22')->shouldReturn(false);
        $this->validate('+33(1)22 22 22 22 -- - - - ')->shouldReturn(false);
        $this->validate('+(33)(020)7777 7777')->shouldReturn(false);
        $this->validate('++03-6106666')->shouldReturn(false);
    }
}
