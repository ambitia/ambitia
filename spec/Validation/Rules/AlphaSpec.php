<?php

namespace spec\Ambitia\Validation\Rules;

use Ambitia\Contracts\RuleValidator;
use Ambitia\Validation\Rules\Alpha;
use PhpSpec\ObjectBehavior;

class AlphaSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Alpha::class);
        $this->shouldImplement(RuleValidator::class);
    }

    function it_should_return_true_on_alpha_string()
    {
        foreach (str_split('abcdefghijklmnopqrstuvwxyz') as $char) {
            $this->validate($char)->shouldReturn(true);
        }
    }

    function it_should_return_false_on_other_than_alpha_string()
    {
        foreach (str_split('!@#$%^&*()_+-=`~<>/?;:\'"[]{}.,|\\0123456789') as $char) {
            $this->validate($char)->shouldReturn(false);
        }
    }
}
