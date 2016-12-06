<?php

namespace Ambitia\Interfaces\Console;

interface ArgumentInterface
{
    const VALUE_TYPE_STRING = 'string';
    const VALUE_TYPE_INT = 'int';
    const VALUE_TYPE_FLOAT = 'float';
    const VALUE_TYPE_BOOL = 'bool';

    /**
     * Setup argument settings. This method will be invoked on object construction
     *
     * @return void
     */
    public function setup();

    /**
     * Check if a given prefix maps to this argument
     *
     * @param string $prefix
     * @param bool $any Should it try matching to long and short prefixes or just the short one?
     * @return bool
     */
    public function checkPrefix(string $prefix, $any = true): bool;

    /**
     * Set short prefix for the command argument, without the dash
     *
     * @param string $prefix
     * @return $this
     */
    public function setPrefix(string $prefix);

    /**
     * Set long prefix for the command argument, without the dash
     *
     * @param string $prefix
     * @return $this
     */
    public function setLongPrefix(string $prefix);

    /**
     * Set argument description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description);

    /**
     * Set default value of the argument
     *
     * @param string $value
     * @return $this
     */
    public function setDefaultValue(string $value);

    /**
     * Define if the argument should be required when invoking the command
     * Default: false
     *
     * @param bool $isRequired
     * @return $this
     */
    public function isRequired(bool $isRequired = true);

    /**
     * Define if the argument is a simple true/false switch. Will automatically cast value to boolean.
     * Default: false
     *
     * @param bool $isSwitch
     * @return $this
     */
    public function isSwitch(bool $isSwitch = true);

    /**
     * Set the default value type to which the value should be cast
     * Default: string
     *
     * @param string $type
     * @return $this
     */
    public function setValueType(string $type = self::VALUE_TYPE_STRING);

    /**
     * Set the value for this argument
     *
     * @param mixed $value
     * @return $this
     */
    public function setValue($value);

    /**
     * Get value of this argument
     *
     * @return $this
     */
    public function getValue();

    /**
     * Get array representation of the argument object.
     *
     * @return array
     */
    public function toArray(): array;
}