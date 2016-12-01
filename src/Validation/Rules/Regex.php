<?php namespace Ambitia\Validation\Rules;

use Ambitia\Interfaces\Validation\RuleInterface;

class Regex extends \Respect\Validation\Rules\Regex implements RuleInterface
{
    public function validate($input): bool
    {
        return parent::validate($input);
    }
}
