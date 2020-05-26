<?php

namespace Bearer\Sh\Model\Filters;

use Bearer\Sh\Enum\FilterType;
use Bearer\Sh\Model\ReportLog;

/**
 * Class ResponseHeaderFilter
 * @package Bearer\Sh\Model\Filters
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
		return $log->getResponseHeaders();
	}
}
