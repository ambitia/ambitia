<?php

namespace Ambitia\Validation\Rules;

use Ambitia\Interfaces\Validation\RuleInterface;

class Ip extends \Respect\Validation\Rules\Ip implements RuleInterface
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}