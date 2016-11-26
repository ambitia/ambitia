<?php

namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\Validation\RuleContract;
use Respect\Validation\Rules\AbstractRule;

class Required extends AbstractRule implements RuleContract
{
    public function validate($input): bool
    {
        if (is_string($input)) {
            return strlen(trim($input)) > 0;
        }

        return count($input) > 0;
    }
}
