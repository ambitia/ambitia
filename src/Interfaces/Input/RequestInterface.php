<?php

namespace Ambitia\Interfaces\Input;

interface RequestInterface
{
    /**
     * Get client input for application
     * @return array
     */
    public function input() : array;

}