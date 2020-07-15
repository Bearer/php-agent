<?php

namespace Bearer\Model\Filters;

use Bearer\Enum\FilterType;
use Bearer\Model\ReportLog;

/**
 * Class ResponseBodyFilter
 * @package Bearer\Model\Filters
 */
class ResponseBodyFilter extends KeyValueFilter
{
	/**
	 * @var string
	 */
	protected $typeName = FilterType::RESPONSE_BODY;

	/**
	 * @param ReportLog $log
	 * @return array
	 */
	protected function getMatchParameters(ReportLog $log): array
	{
		$body = $log->getResponseBody();
		$decode_value = json_decode($body, true);
		return $this->flat(is_array($body) ? $body : (is_array($decode_value) ? $decode_value : [$body]));
	}

	/**
	 * @param array $array
	 * @return array
	 */
	private function flat(array $array): array
	{
		$return = [];
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$return = array_merge($return, $this->flat($value));
				$return[$key] = json_encode($value);
			} else {
				$return[$key] = $value;
			}
		}
		return $return;
	}
}
