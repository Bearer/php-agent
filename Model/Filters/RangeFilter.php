<?php

namespace Bearer\Model\Filters;

use Bearer\Model\Range;
use Bearer\Model\ReportLog;

/**
 * Class RangeFilter
 * @package Bearer\Model\Filters
 */
abstract class RangeFilter extends Filter
{
	/**
	 * @var Range
	 */
	private $range;

	/**
	 * @param ReportLog $log
	 * @return bool
	 */
	public function match($log)
	{
		return $this->matchFrom($this->getValue($log)) && $this->matchTo($this->getValue($log));
	}

	/**
	 * @param int $code
	 * @return bool
	 */
	private function matchFrom($code)
	{
		if ($code === null) {
			return false;
		}
		if ($this->getRange()->getFrom() === null) {
			return true;
		}

		if ($this->getRange()->isFromExclusive()) {
			return $code > $this->getRange()->getFrom();
		}

		return $code >= $this->getRange()->getFrom();
	}

	/**
	 * @return Range
	 */
	public function getRange()
	{
		return $this->range;
	}

	/**
	 * @param Range $range
	 * @return StatusCodeFilter
	 */
	public function setRange($range)
	{
		$this->range = $range;

		return $this;
	}

	/**
	 * @param ReportLog $log
	 * @return int|null
	 */
	protected abstract function getValue($log);

	/**
	 * @param int $code
	 * @return bool
	 */
	private function matchTo($code)
	{
		if ($code === null) {
			return false;
		}
		if ($this->getRange()->getTo() === null) {
			return true;
		}

		if ($this->getRange()->isToExclusive()) {
			return $code < $this->getRange()->getTo();
		}

		return $code <= $this->getRange()->getTo();
	}
}
