<?php namespace Ambitia\Validation\Rules;

use Ambitia\Interfaces\Validation\RuleInterface;

class Json extends \Respect\Validation\Rules\Json implements RuleInterface
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}