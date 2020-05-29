<?php

namespace Bearer\Model\Filters;

use Bearer\Enum\FilterType;
use Bearer\Model\ReportLog;

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
		return false;
	}
}
