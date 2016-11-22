<?php

namespace Ambitia\Input\Contracts;

interface RequestContract
{
    /**
     * Get client input for application
     * @return array
     */
    public function input() : array;

}