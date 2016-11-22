<?php

namespace spec\Ambitia\Validation\Rules;

use Ambitia\Contracts\RuleValidator;
use Ambitia\Validation\Rules\Arrayable;
use PhpSpec\ObjectBehavior;

class ArrayableSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Arrayable::class);
        $this->shouldImplement(RuleValidator::class);
    }

    function it_should_return_true_on_arrays_and_array_object()
    {
        $this->validate([])->shouldReturn(true);
        $this->validate([[[[[]]]], [[[]]]], [[]])->shouldReturn(true);
        $this->validate([[[[['ok' => 1]]]], [[[]]]], [[]])->shouldReturn(true);
        $this->validate(new \ArrayObject())->shouldReturn(true);
    }

    function it_should_return_false_on_other_than_array()
    {
        $curl = curl_init();
        $this->validate('f1231j2oe')->shouldReturn(false);
        $this->validate(true)->shouldReturn(false);
        $this->validate(12345)->shouldReturn(false);
        $this->validate(12.345)->shouldReturn(false);
        $this->validate(dechex(12))->shouldReturn(false);
        $this->validate(function () {
            return true;
        })->shouldReturn(false);
        $this->validate((object)array('1' => 'foo'))->shouldReturn(false);
        $this->validate(null)->shouldReturn(false);
        $this->validate($curl)->shouldReturn(false);
        curl_close($curl);
    }
}
