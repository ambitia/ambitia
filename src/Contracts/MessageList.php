<?php

namespace Ambitia\Validation\Contracts;

/**
 * Interface InvalidListContract
 * Should hold information about violated constraints of Validator.
 * @package Ambitia\Validation\Contracts
 */
interface MessageListContract extends \Iterator, \Countable, \ArrayAccess
{
    /**
     * Check if the list is empty
     * @return bool
     */
    public function isEmpty() : bool;

    public function get() :
}