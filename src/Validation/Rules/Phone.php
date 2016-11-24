<?php namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\RuleValidator;

class Phone extends \Respect\Validation\Rules\Phone implements RuleValidator
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}