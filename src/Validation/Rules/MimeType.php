<?php namespace Ambitia\Validation\Rules;

use Ambitia\Interfaces\Validation\RuleInterface;

class MimeType extends \Respect\Validation\Rules\Mimetype implements RuleInterface
{
    public function validate($input) : bool
    {
        return parent::validate($input);
    }
}