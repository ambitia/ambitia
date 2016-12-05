<?php namespace Ambitia\DIContainer\PHPDI;

use Ambitia\Interfaces\DIContainer\ContainerInterface;
use DI\ContainerBuilder;

class Container implements ContainerInterface
{
    protected $container;

    public function __construct($config = [])
    {
        $builder = new ContainerBuilder();
        foreach ($config['map'] as &$dependency) {
            $object = \DI\object($dependency);
            if (!empty($config['properties'][$dependency])) {
                foreach ($config['properties'][$dependency] as $param => $value) {
                    $object->constructorParameter($param, $value);
                }
            }
            $dependency = $object;
        }
        $builder->addDefinitions($config['map']);
        $this->container = $builder->build();
    }

    /**
     * @inheritDoc
     */
    public function get(string $id)
    {
        return $this->container->get($id);
    }

    /**
     * @inheritDoc
     */
    public function has(string $id): bool
    {
        return $this->container->has($id);
    }
}