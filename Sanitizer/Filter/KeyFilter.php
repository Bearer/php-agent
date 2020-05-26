<?php

namespace Bearer\Sh\Sanitizer\Filter;

use Bearer\Sh\Model\Configuration;

/**
 * Trait KeyFilter
 * @package Bearer\Sh\Sanitizer\Filter
 */
trait KeyFilter
{
	/**
	 * @param $data
	 * @return array|array[]|string
	 */
	private function keys($data)
	{
		if (!is_array($data)) {
			return $data;
		}

		$data = array_combine(array_keys($data), array_map(function ($value, $key) {
				if (Configuration::get()->matchStripSensitiveKeys($key)) {
					return "[FILTERED]";
				}
				return $value;
			}, $data, array_keys($data))
		);

		return array_combine(array_keys($data), array_map(function ($value) {
			return $this->keys($value);
		}, $data));
	}
}
