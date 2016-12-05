<?php namespace Ambitia\Interfaces\DIContainer;


interface ContainerInterface
{
    /**
     * Find an entry of the container by its identifier and return it
     *
     * @param string $id
     * @return mixed
     */
    public function get(string $id);

    /**
     * Check if container has entry by specified id.
     *
     * @param string $id
     * @return bool
     */
    public function has(string $id): bool;
}