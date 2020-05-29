<?php

namespace Bearer\Sanitizer;

use Bearer\Model\Configuration;
use Bearer\Sanitizer\Filter\KeyFilter;
use Bearer\Sanitizer\Filter\ValueFilter;

/**
 * Class AbstractSanitizer
 * @package Bearer\Sanitizer\Handler
 */
abstract class AbstractSanitizeHandler
{
	use KeyFilter;
	use ValueFilter;

	/**
	 * @param $data
	 * @return array|string|string[]|null
	 */
	protected function filter($data)
	{
		if(Configuration::get()->isStripSensitiveData()) {
			$data = $this->values($this->keys($data));
		}

		return $data;
	}
}
