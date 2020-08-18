<?php

namespace Bearer\Model;

/**
 * Class RegularExpression
 */
class RegularExpression
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $flags = "";

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return RegularExpression
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * @param string $flags
     * @return RegularExpression
     */
    public function setFlags($flags)
    {
        $this->flags = $flags;

        return $this;
    }
}
