<?php

namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\Validation\RuleContract;

class Ip extends \Respect\Validation\Rules\Ip implements RuleContract
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}