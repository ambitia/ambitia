<?php

namespace Ambitia\Validation\Rules;

use Ambitia\Interfaces\Validation\RuleInterface;

class Url extends \Respect\Validation\Rules\Url implements RuleInterface
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}
