<?php

namespace Bearer\Sh\Model\Filters;

use Bearer\Sh\Enum\FilterType;
use Bearer\Sh\Model\Range;
use Bearer\Sh\Model\ReportLog;

/**
 * Class StatusCodeFilter
 */
class StatusCodeFilter extends Filter
{
	/**
	 * @var string
	 */
	protected $typeName = FilterType::STATUS_CODE;

	/**
	 * @var Range
	 */
	private $range;

	/**
	 * @param ReportLog $log
	 * @return bool
	 */
	public function match(ReportLog $log): bool
	{
		$code = $log->getStatusCode();

		return $this->matchFrom($code) && $this->matchTo($code);
	}

	/**
	 * @param int $code
	 * @return bool
	 */
	private function matchFrom(int $code): bool
	{
		if ($this->getRange()->isFromExclusive()) {
			return $code > $this->getRange()->getFrom();
		}

		return $code >= $this->getRange()->getFrom();
	}

	/**
	 * @return Range
	 */
	public function getRange(): Range
	{
		return $this->range;
	}

	/**
	 * @param Range $range
	 * @return StatusCodeFilter
	 */
	public function setRange(Range $range): StatusCodeFilter
	{
		$this->range = $range;

		return $this;
	}

	/**
	 * @param int $code
	 * @return bool
	 */
	private function matchTo(int $code): bool
	{
		if ($this->getRange()->isToExclusive()) {
			return $code < $this->getRange()->getTo();
		}

		return $code <= $this->getRange()->getTo();
	}
}
