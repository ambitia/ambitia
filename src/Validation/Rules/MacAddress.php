<?php

namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\RuleValidator;

class MacAddress extends \Respect\Validation\Rules\MacAddress implements RuleValidator
{
    /**
     * IEEE 802 standards define 3 formats for MAC address in hexadecimal digits:
     * - Six groups of two hexadecimal digits separated by hyphens (-), like 01-23-45-67-89-ab
     * - Six groups of two hexadecimal digits separated by colons (:), like 01:23:45:67:89:ab
     * - Three groups of four hexadecimal digits separated by dots (.), like 0123.4567.89ab
     * @param mixed $input
     * @return bool
     */
    public function validate($input) : bool
    {
        if (!empty($input) && preg_match('/^([a-fA-F0-9]{4}\.){2}[a-fA-F0-9]{4}$/', $input)) {
            return true;
        }

        return parent::validate($input);
    }
}
