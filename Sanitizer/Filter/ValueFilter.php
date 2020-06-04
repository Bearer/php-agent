<?php

namespace Bearer\Sanitizer\Filter;

use Bearer\Model\Configuration;

/**
 * Trait ValueFilter
 * @package Bearer\Sanitizer\Filter
 */
trait ValueFilter
{
	/**
	 * @param $data
	 */
	private function values($data)
	{
		if(!is_array($data)) {
			return Configuration::get()->replaceStripSensitiveRegex($data);
		}

		return array_combine(array_keys($data),
			array_map(function ($value) {
				return $this->values($value);
			}, $data)
		);
	}
}
