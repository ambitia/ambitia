<?php namespace Ambitia\Validation\Rules;

use Ambitia\Interfaces\Validation\RuleInterface;

class ArrayType extends \Respect\Validation\Rules\ArrayType implements RuleInterface
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}