<?php namespace Ambitia\Validation\Rules;

use Ambitia\Interfaces\Validation\RuleInterface;

class Date extends \Respect\Validation\Rules\Date implements RuleInterface
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