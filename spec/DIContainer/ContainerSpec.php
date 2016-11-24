<?php

namespace spec\Ambitia\DIContainer;

use Ambitia\DIContainer\Container;
use DI\ContainerBuilder;
use PhpSpec\ObjectBehavior;

class ContainerSpec extends ObjectBehavior
{
    function let()
    {
        $containerConfig = include __DIR__ . '/../../src/Config/dependencies.php';
        $this->beConstructedWith(new ContainerBuilder(), $containerConfig);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Container::class);
    }

    function it_should_check_if_dependency_is_available_for_contract()
    {
        $containerConfig = include __DIR__ . '/../../src/Config/dependencies.php';
        foreach ($containerConfig as $contract => $class) {
            $this->has($contract)->shouldBe(true);
        }
    }

}
