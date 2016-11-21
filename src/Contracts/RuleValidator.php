<?php namespace Ambitia\Contracts;


interface RuleValidator
{
    /**
     * @param mixed $input
     * @return bool
     */
    public function validate($input) : bool;
}