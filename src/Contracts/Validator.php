<?php

namespace Ambitia\Contracts;

/**
 * Validate values against certain rules (constraints)
 */
interface Validator
{

    /**
     * Validates a value against an array of constraints
     * @param array $values Array of key value pairs, where key is a field name and it's
     * value is going to be put under validation.
     * @return bool
     */
    public function validate(array $values): bool;

    /**
     * Get extended information about which validators passed and which didn't
     * @return array
     */
    public function result(): array;
}