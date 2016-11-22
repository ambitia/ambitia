<?php

namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\RuleValidator;

class Ip extends \Respect\Validation\Rules\Ip implements RuleValidator
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}