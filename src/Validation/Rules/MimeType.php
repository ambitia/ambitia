<?php namespace Ambitia\Validation\Rules;

use Ambitia\Contracts\Validation\RuleContract;

class MimeType extends \Respect\Validation\Rules\Mimetype implements RuleContract
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}