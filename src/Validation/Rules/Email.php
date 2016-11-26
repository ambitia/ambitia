<?php namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\Validation\RuleContract;

class Email extends \Respect\Validation\Rules\Email implements RuleContract
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}
