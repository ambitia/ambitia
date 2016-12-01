<?php namespace Ambitia\Validation\Rules;


use Ambitia\Interfaces\Validation\RuleInterface;
use Respect\Validation\Rules\ArrayVal;

class Arrayable extends ArrayVal implements RuleInterface
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}