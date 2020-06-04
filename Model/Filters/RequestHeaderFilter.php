<?php

namespace Bearer\Model\Filters;

use Bearer\Enum\FilterType;
use Bearer\Model\ReportLog;

/**
 * Class RequestHeaderFilter
 * @package Bearer\Model\Filters
 */
class RequestHeaderFilter extends KeyValueFilter
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
		return $log->getRequestHeaders();
	}
}
