<?php namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\RuleValidator;

class Alpha extends \Respect\Validation\Rules\Alpha implements RuleValidator
{
    public function validate($input) : bool
    {
        return $this->validateClean($input);
    }
}