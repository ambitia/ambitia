<?php namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\Validation\RuleContract;

class AlNum extends \Respect\Validation\Rules\Alnum implements RuleContract
{
    public function validate($input) : bool
    {
        return $this->validateClean($input);
    }
}