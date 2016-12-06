<?php namespace Ambitia\Console;

use Ambitia\Interfaces\Console\ArgumentInterface;

abstract class Argument implements ArgumentInterface
{
    protected $prefix = null;
    protected $longPrefix = null;
    protected $description = '';
    protected $defaultValue = null;
    protected $required = false;
    protected $switch = false;
    protected $valueType = self::VALUE_TYPE_STRING;
    protected $value = null;

    public function __construct()
    {
        $this->setup();
    }

    /**
     * @inheritDoc
     */
    abstract public function setup();

    /**
     * @inheritDoc
     */
    public function checkPrefix(string $prefix, $any = true): bool
    {
        return ($this->prefix === $prefix || $this->longPrefix === $prefix);
    }

    /**
     * @inheritDoc
     */
    public function setPrefix(string $prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setLongPrefix(string $prefix)
    {
        $this->longPrefix = $prefix;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setDefaultValue(string $value)
    {
        $this->defaultValue = $value;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isRequired(bool $isRequired = true)
    {
        $this->required = $isRequired;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isSwitch(bool $isSwitch = true)
    {
        $this->switch = $isSwitch;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setValueType(string $type = self::VALUE_TYPE_STRING)
    {
        $this->valueType = $type;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function getValue()
    {
        if (empty($this->value)) {
            settype($this->defaultValue, $this->valueType);

            return $this->defaultValue;
        }
        settype($this->value, $this->valueType);

        return $this->value;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
