<?php namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\Validation\RuleContract;

class Regex extends \Respect\Validation\Rules\Regex implements RuleContract
{
    public function validate($input): bool
    {
        return parent::validate($input);
    }
}
