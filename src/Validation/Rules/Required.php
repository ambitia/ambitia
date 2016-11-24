<?php

namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\RuleValidator;
use Respect\Validation\Rules\AbstractRule;

class Required extends AbstractRule implements RuleValidator
{
    public function validate($input): bool
    {
        if (is_string($input)) {
            return strlen(trim($input)) > 0;
        }

        return count($input) > 0;
    }
}
