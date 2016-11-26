<?php namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\Validation\RuleContract;

class Alpha extends \Respect\Validation\Rules\Alpha implements RuleContract
{
    public function validate($input) : bool
    {
        return $this->validateClean($input);
    }
}