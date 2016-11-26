<?php namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\Validation\RuleContract;

class ArrayType extends \Respect\Validation\Rules\ArrayType implements RuleContract
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}