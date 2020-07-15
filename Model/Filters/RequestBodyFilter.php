<?php

namespace Bearer\Model\Filters;

use Bearer\Enum\FilterType;
use Bearer\Model\ReportLog;

/**
 * Class RequestBodyFilter
 * @package Bearer\Model\Filters
 */
class RequestBodyFilter extends KeyValueFilter
{
	/**
	 * @var string
	 */
	protected $typeName = FilterType::REQUEST_BODY;

	/**
	 * @param ReportLog $log
	 * @return array
	 */
	protected function getMatchParameters(ReportLog $log): array
	{
		$body = $log->getRequestBody();
		$decode_value = json_decode($body);

		return is_array($body) ? $body : (is_array($decode_value) ? $decode_value : [$body]);
	}
}
