<?php

namespace Bearer\Model\Filters;

use Bearer\Enum\FilterType;
use Bearer\Model\ReportLog;

/**
 * Class ResponseHeaderFilter
 * @package Bearer\Model\Filters
 */
class ResponseHeaderFilter extends KeyValueFilter
{
    /**
     * @var string
     */
    protected $typeName = FilterType::RESPONSE_HEADER;

	/**
	 * @param ReportLog $log
	 * @return array
	 */
	protected function getMatchParameters(ReportLog $log): array
	{
		return $log->getResponseHeaders() ?? [];
	}
}
