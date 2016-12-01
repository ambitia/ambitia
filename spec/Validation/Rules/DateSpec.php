<?php

namespace spec\Ambitia\Validation\Rules;

use Ambitia\Interfaces\Validation\RuleInterface;
use Ambitia\Validation\Rules\Date;
use PhpSpec\ObjectBehavior;

class DateSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Date::class);
        $this->shouldImplement(RuleInterface::class);
    }

    function it_should_validate_date()
    {
        $this->validate('2015-01-02')->shouldReturn(true);
        $this->validate('+1 day')->shouldReturn(true);
        $this->validate(new \DateTime())->shouldReturn(true);
    }

    function it_should_validate_date_by_specific_format()
    {
        $this->beConstructedWith('d/m/Y');
        $this->validate('2015-01-02')->shouldReturn(false);
        $this->validate('01/01/2017')->shouldReturn(true);
        $this->validate('+1 day')->shouldReturn(false);
    }
}
