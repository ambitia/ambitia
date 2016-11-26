<?php

namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\Validation\RuleContract;

class Url extends \Respect\Validation\Rules\Url implements RuleContract
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}
