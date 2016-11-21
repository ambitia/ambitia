<?php namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\RuleValidator;

class AlNum extends \Respect\Validation\Rules\Alnum implements RuleValidator
{
    public function validate($input) : bool
    {
        return parent::validateClean($input);
    }
}