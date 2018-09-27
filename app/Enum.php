<?php

namespace App;

use Exception;
use ReflectionClass;

abstract class Enum
{
    protected $value;

    /**
     * @param string $value Value for this display type
     *
     * @throws Exception
     */
    public function __construct($value)
    {
        $this->setValue($value);
    }

    public static function getAllValues()
    {
        return array_values(self::getAllConstants());
    }

    public static function getAllConstants()
    {
        $reflector = new ReflectionClass(get_called_class());
        return $reflector->getConstants();
    }

    /**
     * Return string representation of this enum
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Tries to set the value  of this enum
     *
     * @param string $value
     *
     * @throws Exception If value is not part of this enum
     */
    public function setValue($value)
    {
        if ($this->isValidEnumValue($value)) {
            $this->value = $value;
        } else {
            throw new Exception("Invalid type specified: {$value}");
        }
    }

    /**
     * Validates if the type given is part of this enum class
     *
     * @param string $checkValue
     *
     * @return bool
     */
    public function isValidEnumValue($checkValue)
    {
        $constants = self::getAllConstants();
        foreach ($constants as $validValue) {
            if ($validValue == $checkValue) {
                return true;
            }
        }
        return false;
    }

    /**
     * With a magic getter you can get the value from this enum using
     * any variable name as in:
     *
     * <code>
     *   $myEnum = new MyEnum(MyEnum::start);
     *   echo $myEnum->v;
     * </code>
     *
     * @param string $property
     *
     * @return string
     */
    public function __get($property)
    {
        return $this->value;
    }

    /**
     * With a magic setter you can set the enum value using any variable
     * name as in:
     *
     * <code>
     *   $myEnum = new MyEnum(MyEnum::Start);
     *   $myEnum->v = MyEnum::End;
     * </code>
     *
     * @param string $property
     * @param string $value
     *
     * @throws Exception Throws exception if an invalid type is used
     */
    public function __set($property, $value)
    {
        $this->setValue($value);
    }

    /**
     * If the enum is requested as a string then this function will be automatically
     * called and the value of this enum will be returned as a string.
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->value;
    }
}
