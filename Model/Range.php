<?php

namespace Bearer\Model;

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
     * @return float|null
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param float|null $from
     * @return Range
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFromExclusive()
    {
        return $this->fromExclusive;
    }

    /**
     * @param bool $fromExclusive
     * @return Range
     */
    public function setFromExclusive($fromExclusive)
    {
        $this->fromExclusive = $fromExclusive;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param float|null $to
     * @return Range
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @return bool
     */
    public function isToExclusive()
    {
        return $this->toExclusive;
    }

    /**
     * @param bool $toExclusive
     * @return Range
     */
    public function setToExclusive($toExclusive)
    {
        $this->toExclusive = $toExclusive;

        return $this;
    }
}
