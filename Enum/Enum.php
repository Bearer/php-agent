<?php

namespace Bearer\Enum;

/**
 * Class Enum
 */
class Enum
{
    /**
     * @return array
     * @throws \ReflectionException
     */
    public function getConstantsValues()
    {
        return array_values((new \ReflectionClass($this))->getConstants());
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function getConstants()
    {
        return (new \ReflectionClass($this))->getConstants();
    }
}
