<?php

namespace spec\Ambitia\Validation\Rules;

use Ambitia\Interfaces\Validation\RuleInterface;
use Ambitia\Validation\Rules\ArrayType;
use PhpSpec\ObjectBehavior;

class ArrayTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ArrayType::class);
        $this->shouldImplement(RuleInterface::class);
    }

    function it_should_return_true_on_arrays()
    {
        $this->validate([])->shouldReturn(true);
        $this->validate([[[[[]]]], [[[]]]], [[]])->shouldReturn(true);
        $this->validate([[[[['ok' => 1]]]], [[[]]]], [[]])->shouldReturn(true);
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
        $this->validate(new \ArrayObject())->shouldReturn(false);
    }
}
