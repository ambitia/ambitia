<?php

namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\RuleValidator;
use Respect\Validation\Rules\AbstractRule;

class Required extends AbstractRule implements RuleValidator
{
    public function validate($input): bool
    {
        if (is_string($input)) {
            $input = trim($input);
        }

        return (is_string($input) && strlen($input) > 0) ||
            (!is_string($input) && count($input) > 0);
    }
}
