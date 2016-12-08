<?php

namespace spec\Ambitia\Console;

use Ambitia\Console\Application;
use Ambitia\Console\CLimate\MessageFormatter;
use Ambitia\Console\CLimate\Request;
use Ambitia\Console\CLimate\Response;
use Ambitia\Console\Commands\HelpCommand;
use Ambitia\Console\Exceptions\NoSuchCommandException;
use Ambitia\Example\Test\TestCommand;
use League\CLImate\CLImate;
use PhpSpec\ObjectBehavior;

class ApplicationSpec extends ObjectBehavior
{
    function let()
    {
        $request = new Request(['ambitia.php', 'help']);
        $request->setCommandName('test');
        $response = new Response(new MessageFormatter(new CLImate()));
        $this->beConstructedWith($request, $response);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Application::class);
    }

    function it_should_be_possible_to_register_new_command()
    {
        $command = new TestCommand();
        $this->registerCommand('test', TestCommand::class);
        $this->getCommand('test')->shouldBeLike($command);
    }

    function it_should_be_possible_to_register_multiple_commands()
    {
        $this->registerCommands([
            'test' => TestCommand::class,
            'help' => HelpCommand::class
        ]);

        $this->getCommand('test')->shouldBeLike(new TestCommand());
        $this->getCommand('help')->shouldBeLike(new HelpCommand());
    }

    function it_should_throw_exception_when_no_command_by_specified_name()
    {
        $this->shouldThrow(NoSuchCommandException::class)->during('getCommand', ['no_such_command']);
    }

    function it_should_execute_commands()
    {
        $this->registerCommand('test', TestCommand::class);
        $this->shouldThrow(new \Exception('success'))->during('execute');
    }
}
