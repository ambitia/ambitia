<?php namespace Ambitia\Contracts\Validation;


interface RuleContract
{
    /**
     * @param mixed $input
     * @return bool
     */
    public function validate($input) : bool;
}