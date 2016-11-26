<?php namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\Validation\RuleContract;

class Phone extends \Respect\Validation\Rules\Phone implements RuleContract
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}