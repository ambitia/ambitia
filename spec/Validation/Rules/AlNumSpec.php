<?php

namespace spec\Ambitia\Validation\Rules;

use Ambitia\Contracts\RuleValidator;
use Ambitia\Validation\Rules\AlNum;
use PhpSpec\ObjectBehavior;

class AlNumSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AlNum::class);
        $this->shouldImplement(RuleValidator::class);
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
    }

    function it_should_return_false_on_space_or_enter()
    {
        $this->validate(' ')->shouldReturn(false);
        $this->validate('
        ')->shouldReturn(false);
    }
}
