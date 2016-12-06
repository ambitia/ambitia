<?php

namespace spec\Ambitia\Console\CLimate;

use Ambitia\Console\Arguments\TestArgument;
use Ambitia\Console\CLimate\Request;
use PhpSpec\ObjectBehavior;

class RequestSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(['ambitia.php', 'test']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Request::class);
    }

    function it_should_be_possible_to_get_arguments()
    {
        $this->beConstructedWith(['ambitia.php', 'help', '-t=something else']);
        $this->addPossibleArguments([TestArgument::class]);
        $argument = new TestArgument();
        $argument->setValue('something else');
        $this->getArguments()[0]->shouldBeLike(
            $argument
        );
    }

    function it_should_be_possible_to_get_command_name_requested()
    {
        $this->getCommandName()->shouldReturn('test');
    }
}
