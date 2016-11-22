<?php namespace Ambitia\Validation\Rules;


use Ambitia\Contracts\RuleValidator;
use Respect\Validation\Rules\ArrayVal;

class Arrayable extends ArrayVal implements RuleValidator
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}