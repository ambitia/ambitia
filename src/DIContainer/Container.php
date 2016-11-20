<?php namespace Ambitia\DIContainer;

use DI\ContainerBuilder;
use Interop\Container\ContainerInterface;

class Container implements ContainerInterface
{
    protected $container;

    public function __construct(ContainerBuilder $builder, $config = [])
    {
        $builder->addDefinitions($config);
        $this->container = $builder->build();
    }

    /**
     * @inheritDoc
     */
    public function get($id)
    {
        return $this->container->get($id);
    }

    /**
     * @inheritDoc
     */
    public function has($id)
    {
        return $this->container->has($id);
    }
}