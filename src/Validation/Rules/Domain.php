<?php namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\Validation\RuleContract;

class Domain extends \Respect\Validation\Rules\Domain implements RuleContract
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}
