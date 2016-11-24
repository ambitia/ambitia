<?php namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\RuleValidator;

class Json extends \Respect\Validation\Rules\Json implements RuleValidator
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}