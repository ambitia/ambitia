<?php

namespace Ambitia\Contracts;

/**
 * Validate values against certain rules (constraints)
 */
interface Validator
{

    /**
     * Validates a value against an array of constraints
     * @param mixed $value
     * @param string[] $rules Array of \Ambitia\Contracts\Rule constants
     * @return bool
     */
    public function validate($value, array $rules) : bool;
}