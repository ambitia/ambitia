<?php

namespace Ambitia\Interfaces;

/**
 * Holds messages grouped by string keys
 */
interface MessageList extends \Iterator, \Countable, \ArrayAccess
{
    /**
     * Check if the list is empty
     * @return bool
     */
    public function isEmpty() : bool;

    /**
     * Get all messages for the given index
     * @param string $key
     * @return Message[]
     */
    public function get(string $key) : array;

    /**
     * @param string $key
     * @param string $message
     * @return $this
     */
    public function add(string $key, string $message);
}