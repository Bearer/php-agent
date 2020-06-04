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
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return RegularExpression
     */
    public function setValue(string $value): RegularExpression
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getFlags(): string
    {
        return $this->flags;
    }

    /**
     * @param string $flags
     * @return RegularExpression
     */
    public function setFlags(string $flags): RegularExpression
    {
        $this->flags = $flags;

        return $this;
    }
}
