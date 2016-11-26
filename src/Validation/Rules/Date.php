<?php namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\Validation\RuleContract;

class Date extends \Respect\Validation\Rules\Date implements RuleContract
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