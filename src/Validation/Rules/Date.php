<?php namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\RuleValidator;

class Date extends \Respect\Validation\Rules\Date implements RuleValidator
{
    public function __construct($format = null)
    {
        parent::__construct($format);
    }

    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}