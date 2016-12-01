<?php namespace Ambitia\Interfaces\Validation;


interface RuleInterface
{
    /**
     * @param mixed $input
     * @return bool
     */
    public function validate($input) : bool;
}