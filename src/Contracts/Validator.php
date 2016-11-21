<?php

namespace Ambitia\Validation\Contracts;

/**
 * Validate values against certain rules (constraints)
 *
 * @author Artur Śmiarowski <artur.smiarowski@gmail.com>
 */
interface ValidatorContract
{

    /**
     * Validates a value against an array of constraints
     * @param mixed $value
     * @param \Symfony\Component\Validator\Constraint[] $constraints
     * @return MessageListContract
     */
    public function validate($value, array $constraints) : MessageListContract;
}