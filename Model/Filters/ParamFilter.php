<?php

namespace Bearer\Model\Filters;

use Bearer\Enum\FilterType;
use Bearer\Model\ReportLog;

/**
 * Class ParamFilter
 */
class ParamFilter extends KeyValueFilter
{
	/**
	 * @var string
	 */
	protected $typeName = FilterType::PARAM;

	/**
	 * @param ReportLog $log
	 * @return array
	 */
	public function getMatchParameters(ReportLog $log): array
	{
		$params = parse_url($log->getUrl(), PHP_URL_QUERY);
		if ($params === null) {
			return [];
		}

		parse_str($params, $params);

		return $params;
	}


}
