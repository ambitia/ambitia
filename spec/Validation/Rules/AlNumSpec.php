<?php

namespace spec\Ambitia\Validation\Rules;

use Ambitia\Interfaces\Validation\RuleInterface;
use Ambitia\Validation\Rules\AlNum;
use PhpSpec\ObjectBehavior;

class AlNumSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AlNum::class);
        $this->shouldImplement(RuleInterface::class);
    }

    function it_should_return_true_on_alpha_numeric_string()
    {
        $this->validate('2131onjono')->shouldReturn(true);
        $this->validate('onjono')->shouldReturn(true);
        $this->validate('2131')->shouldReturn(true);
    }

    function it_should_return_false_on_other_than_alpha_numeric_string()
    {
        foreach (str_split('!@#$%^&*()_+-=`~<>/?;:\'"[]{}.,|\\') as $char) {
            $this->validate($char)->shouldReturn(false);
        }
        $curl = curl_init();
        $this->validate([])->shouldReturn(false);
        $this->validate(true)->shouldReturn(false);
        $this->validate(12.345)->shouldReturn(false);
        $this->validate(function () {
            return true;
        })->shouldReturn(false);
        $this->validate((object)array('1' => 'foo'))->shouldReturn(false);
        $this->validate(null)->shouldReturn(false);
        $this->validate($curl)->shouldReturn(false);
        curl_close($curl);
    }

    function it_should_return_false_on_space_or_enter()
    {
        $this->validate(' ')->shouldReturn(false);
        $this->validate('
        ')->shouldReturn(false);
    }
}
