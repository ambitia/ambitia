<?php

namespace Ambitia\Contracts\Input;

interface RequestContract
{
    /**
     * Get client input for application
     * @return array
     */
    public function input() : array;

}