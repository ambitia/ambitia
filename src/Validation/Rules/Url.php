<?php

namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\RuleValidator;

class Url extends \Respect\Validation\Rules\Url implements RuleValidator
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}
