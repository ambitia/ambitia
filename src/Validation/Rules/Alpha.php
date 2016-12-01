<?php namespace Ambitia\Validation\Rules;

use Ambitia\Interfaces\Validation\RuleInterface;

class Alpha extends \Respect\Validation\Rules\Alpha implements RuleInterface
{
    public function validate($input) : bool
    {
        return $this->validateClean($input);
    }
}