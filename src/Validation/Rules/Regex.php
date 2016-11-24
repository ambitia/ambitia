<?php namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\RuleValidator;

class Regex extends \Respect\Validation\Rules\Regex implements RuleValidator
{
    public function validate($input): bool
    {
        return parent::validate($input);
    }
}
