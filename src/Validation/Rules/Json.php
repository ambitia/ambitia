<?php namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\Validation\RuleContract;

class Json extends \Respect\Validation\Rules\Json implements RuleContract
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}