<?php

namespace Bearer\Model\Filters;

use Bearer\Enum\FilterType;
use Bearer\Model\ReportLog;

/**
 * Class RequestBodySizeFilter
 * @package Bearer\Model\Filters
 */
class RequestBodySizeFilter extends RangeFilter
{
	/**
	 * @var string
	 */
	protected $typeName = FilterType::REQUEST_BODY_SIZE;

	/**
	 * @param ReportLog $log
	 * @return int|null
	 */
	protected function getValue($log)
	{
		$body = $log->getRequestBody();

		return is_array($body) ? strlen(json_encode($body)) : strlen($body);
	}
}
