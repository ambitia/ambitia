<?php namespace Ambitia\Validation\Rules;

use Ambitia\Interfaces\Validation\RuleInterface;

class Domain extends \Respect\Validation\Rules\Domain implements RuleInterface
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}
