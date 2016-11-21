<?php namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\RuleValidator;

class ArrayType extends \Respect\Validation\Rules\ArrayType implements RuleValidator
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}