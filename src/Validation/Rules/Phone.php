<?php namespace Ambitia\Validation\Rules;

use Ambitia\Interfaces\Validation\RuleInterface;

class Phone extends \Respect\Validation\Rules\Phone implements RuleInterface
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}