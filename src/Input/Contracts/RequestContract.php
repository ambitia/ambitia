<?php

namespace Ambitia\Input\Contracts;

interface RequestContract
{
    /**
     * Get client input for application
     * @return array
     */
    function input() : array;

}