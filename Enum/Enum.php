<?php

namespace Bearer\Sh\Enum;

/**
 * Class Enum
 */
class Enum
{
    /**
     * @return array
     * @throws \ReflectionException
     */
    public function getConstantsValues(): array
    {
        return array_values((new \ReflectionClass($this))->getConstants());
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function getConstants(): array
    {
        return (new \ReflectionClass($this))->getConstants();
    }
}
