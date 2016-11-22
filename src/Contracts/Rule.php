<?php

namespace Ambitia\Contracts;


interface Rule
{
    /**
     * Input consists of alphanumeric characters from a-Z and 0-9.
     *
     * 'dawd adaf123' = true
     * '@$5m52-' = false
     */
    const ALNUM = 'Alnum';

    /**
     * Input consists only of alphabetic characters
     */
    const ALPHA = 'Alpha';

    /**
     * Input is a PHP array.
     */
    const ARRAY = 'ArrayType';

    /**
     * Input is an array or instance of ArrayAccess.
     */
    const ARRAYABLE = 'ArrayVal';

    /**
     * Input is a boolean.
     */
    const BOOLEAN = 'BoolVal';

    /**
     * Input is a callable value.
     */
    const CALLABLE = 'CallableType';

    /**
     * Input can be counted with count().
     */
    const COUNTABLE = 'Countable';

    /**
     * Input is viable strtotime input, can take date format as parameter.
     */
    const DATE = 'Date';

    /**
     * Input is considered by PHP as false.
     */
    const FALSE = 'FalseVal';

    /**
     * Input is a float.
     * 0.5 = true
     * '0.5' = false
     * 0e5 = true
     */
    const FLOAT = 'FloatType';

    /**
     * Input is an instance of a given class or interface
     */
    const INSTANCE = 'Instance';

    /**
     * Input is an integer or string castable to integer
     * '5' = true
     * 5 = true
     */
    const INTVAL = 'IntVal';

    /**
     * Input type is an integer
     * '5' = false
     * 5 = true
     */
    const INTEGER = 'Integer';


}