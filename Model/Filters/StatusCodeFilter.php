<?php

namespace Bearer\Model\Filters;

use Bearer\Enum\FilterType;
use Bearer\Model\Range;
use Bearer\Model\ReportLog;

/**
 * Class StatusCodeFilter
 */
class StatusCodeFilter extends RangeFilter
{
	/**
	 * @var string
	 */
	protected $typeName = FilterType::STATUS_CODE;

	/**
	 * @param ReportLog $log
	 * @return int|null
	 */
	protected function getValue($log)
	{
		return $log->getStatusCode();
	}
}
