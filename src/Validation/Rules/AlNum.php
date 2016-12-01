<?php namespace Ambitia\Validation\Rules;

use Ambitia\Interfaces\Validation\RuleInterface;

class AlNum extends \Respect\Validation\Rules\Alnum implements RuleInterface
{
    public function validate($input) : bool
    {
        return $this->validateClean($input);
    }
}