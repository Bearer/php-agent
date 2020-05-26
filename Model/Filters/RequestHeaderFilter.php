<?php

namespace Bearer\Sh\Model\Filters;

use Bearer\Sh\Enum\FilterType;
use Bearer\Sh\Model\ReportLog;

/**
 * Class RequestHeaderFilter
 * @package Bearer\Sh\Model\Filters
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
