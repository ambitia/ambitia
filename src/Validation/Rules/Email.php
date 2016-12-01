<?php namespace Ambitia\Validation\Rules;

use Ambitia\Interfaces\Validation\RuleInterface;

class Email extends \Respect\Validation\Rules\Email implements RuleInterface
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}
