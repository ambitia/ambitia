<?php namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\RuleValidator;

class Domain extends \Respect\Validation\Rules\Domain implements RuleValidator
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}
