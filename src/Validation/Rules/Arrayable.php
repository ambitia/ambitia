<?php namespace Ambitia\Validation\Rules;


use Ambitia\Contracts\Validation\RuleContract;
use Respect\Validation\Rules\ArrayVal;

class Arrayable extends ArrayVal implements RuleContract
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}