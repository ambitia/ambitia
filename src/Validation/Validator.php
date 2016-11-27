<?php

namespace Ambitia\Validation;

use Ambitia\Contracts\Validation\RuleContract;
use Ambitia\Contracts\Validation\ValidatorContract;
use Ambitia\Validation\Exceptions\InvalidRulesFormatException;

class Validator implements ValidatorContract
{
    /**
     * Array of key value pairs, where key is an input name and it's value is going to
     * be put under validation.
     * @var array
     */
    protected $values = [];

    /**
     * @var array
     */
    protected $rules = [];

    /**
     * @var array
     */
    protected $validated = [];

    /**
     * Validator constructor.
     * @param RuleContract[] $rules Array of rules assigned to field names.
     */
    public function __construct(array $rules)
    {
        if ($this->checkValidityOfRules($rules)) {
            $this->rules = $rules;
        }
    }

    /**
     * @inheritDoc
     */
    public function validate(array $values): bool
    {
        $this->values = $values;

        $this->validated = array_fill_keys(array_keys($values), []);

        $return = true;
        foreach ($this->values as $inputKey => $inputValue) {
            $rules = $this->rules[$inputKey];
            foreach ($rules as $ruleKey => $ruleValue) {
                $check = $this->validateByTheRule($ruleKey, $ruleValue, $inputKey, $inputValue);
                if (!$check) {
                    $return = false;
                }
            }
        }

        return $return;
    }

    /**
     * @inheritDoc
     * @return array
     */
    public function result(): array
    {
        return $this->validated;
    }

    /**
     * Validate a specific value by one of the rules assigned to it's key.
     * @param int|string $ruleKey
     * @param mixed $ruleValue
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    protected function validateByTheRule($ruleKey, $ruleValue, string $key, $value): bool
    {
        $rule = $this->decideWhichIsRule($ruleKey, $ruleValue);
        $ruleInstance = $this->createRuleObject($rule, $ruleKey, $ruleValue);
        $this->validated[$key][$rule] = $ruleInstance->validate($value);

        return $this->validated[$key][$rule];
    }

    /**
     * Check if there is an array of rules assigned to every input key that
     * needs to be validated
     * @param array $rules
     * @return bool
     * @throws InvalidRulesFormatException
     */
    protected function checkValidityOfRules(array $rules): bool
    {
        foreach ($rules as $key => $array) {
            if (!is_array($array)) {
                throw new InvalidRulesFormatException(
                    sprintf('Field %s under validation should have an array of rules', $key)
                );
            }
            $this->checkIfClassImplementsContract($array);
        }

        return true;
    }

    /**
     * Check if all rules are classes that implement RuleValidator contract
     * @param array $rules Either Rule should be a value in the array, or it's key
     * when additional options need to be passed to that Rule constructor
     * @throws InvalidRulesFormatException
     * @return void
     */
    protected function checkIfClassImplementsContract(array $rules)
    {
        foreach ($rules as $key => $value) {
            $rule = $this->decideWhichIsRule($key, $value);

            $contracts = class_implements($rule);
            if (!isset($contracts[RuleContract::class])) {
                throw new InvalidRulesFormatException(
                    sprintf('Rule class %s does not implement required contract %s',
                        $rule, RuleContract::class)
                );
            }
        }
    }

    /**
     * @param string|int $key If key is integer, $value the Rule class name
     * @param string $value If key is a string, $value are options passed to Rule constructor
     * @return string
     */
    protected function decideWhichIsRule($key, $value): string
    {
        return is_string($key) ? $key : $value;
    }

    /**
     * If rule is the array key, initiate it with $value as a construction parameter, otherwise
     * initiate $value since it's the validation Rule.
     * @param string $rule
     * @param string|int $key
     * @param string $value
     * @return RuleContract
     */
    protected function createRuleObject($rule, $key, $value): RuleContract
    {
        if ($rule === $key) {
            return new $key($value);
        }

        return new $value();
    }
}
