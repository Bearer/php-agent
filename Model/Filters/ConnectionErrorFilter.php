<?php

namespace Bearer\Sh\Model\Filters;

use Bearer\Sh\Enum\FilterType;
use Bearer\Sh\Enum\ReportLogType;
use Bearer\Sh\Model\ReportLog;

/**
 * Class ConnectionErrorFilter
 */
class ConnectionErrorFilter extends Filter
{
	protected $typeName = FilterType::CONNECTION_ERROR;

	/**
	 * @param ReportLog $log
	 * @return bool
	 */
	public function match(ReportLog $log): bool
	{
		return $log->getType() === ReportLogType::ERROR;
	}
}
