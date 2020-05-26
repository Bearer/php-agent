<?php

namespace Bearer\Sh\Sanitizer;

use Bearer\Sh\Model\Configuration;
use Bearer\Sh\Sanitizer\Filter\KeyFilter;
use Bearer\Sh\Sanitizer\Filter\ValueFilter;

/**
 * Class AbstractSanitizer
 * @package Bearer\Sh\Sanitizer\Handler
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
