<?php namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\RuleValidator;

class Email extends \Respect\Validation\Rules\Email implements RuleValidator
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}
