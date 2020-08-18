<?php

namespace Bearer\Model\Filters;

use Bearer\Enum\FilterType;
use Bearer\Model\ReportLog;

/**
 * Class ResponseBodySizeFilter
 * @package Bearer\Model\Filters
 */
class ResponseBodySizeFilter extends RangeFilter
{
	/**
	 * @var string
	 */
	protected $typeName = FilterType::RESPONSE_BODY_SIZE;

	/**
	 * @param ReportLog $log
	 * @return int|null
	 */
	protected function getValue($log)
	{
		return $log->getResponseBodySize();
	}
}
