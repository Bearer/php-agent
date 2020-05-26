<?php

namespace Bearer\Sh\Model;

/**
 * Class Range
 */
class Range
{
    /**
     * @var float
     */
    private $from;

    /**
     * @var bool
     */
    private $fromExclusive = false;

    /**
     * @var float
     */
    private $to;

    /**
     * @var bool
     */
    private $toExclusive = false;

    /**
     * @return float
     */
    public function getFrom(): float
    {
        return $this->from;
    }

    /**
     * @param float $from
     * @return Range
     */
    public function setFrom(float $from): Range
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFromExclusive(): bool
    {
        return $this->fromExclusive;
    }

    /**
     * @param bool $fromExclusive
     * @return Range
     */
    public function setFromExclusive(bool $fromExclusive): Range
    {
        $this->fromExclusive = $fromExclusive;

        return $this;
    }

    /**
     * @return float
     */
    public function getTo(): float
    {
        return $this->to;
    }

    /**
     * @param float $to
     * @return Range
     */
    public function setTo(float $to): Range
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @return bool
     */
    public function isToExclusive(): bool
    {
        return $this->toExclusive;
    }

    /**
     * @param bool $toExclusive
     * @return Range
     */
    public function setToExclusive(bool $toExclusive): Range
    {
        $this->toExclusive = $toExclusive;

        return $this;
    }
}
