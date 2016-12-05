<?php

namespace spec\Ambitia\Console;

use Ambitia\Console\Application;
use Ambitia\Console\CLimate\MessageFormatter;
use Ambitia\Console\CLimate\Request;
use Ambitia\Console\CLimate\Response;
use Ambitia\Console\Commands\HelpCommand;
use Ambitia\Example\Test\TestCommand;
use PhpSpec\ObjectBehavior;

class ApplicationSpec extends ObjectBehavior
{
    function let()
    {
        $request = new Request(['ambitia.php', 'help']);
        $response = new Response(new MessageFormatter());
        $this->beConstructedWith($request, $response);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Application::class);
    }

    function it_should_be_possible_to_register_new_command()
    {
        $command = new TestCommand();
        $this->registerCommand(TestCommand::class);
        $this->getCommand($command->getName())->shouldBeLike($command);
    }

    function it_should_be_possible_to_register_multiple_commands()
    {
        $this->registerCommands([
            TestCommand::class,
            HelpCommand::class
        ]);

        $testCommand = new TestCommand();
        $helpCommand = new HelpCommand();
        $this->getCommand($testCommand->getName())->shouldBeLike($testCommand);
        $this->getCommand($helpCommand->getName())->shouldBeLike($helpCommand);
    }
}
