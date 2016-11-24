<?php namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\RuleValidator;

class MimeType extends \Respect\Validation\Rules\Mimetype implements RuleValidator
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}