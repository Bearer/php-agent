<?php

namespace Bearer\Sanitizer;

/**
 * Class HeaderSanitizer
 * @package Bearer\Sanitizer\Handler
 */
class HeaderSanitizer extends AbstractSanitizeHandler
{
	/**
	 * @param array $header
	 * @return array
	 */
	public function __invoke(array $header): array
	{
		foreach ($header as $i => $row) {
			list($header_key, $header_value) = explode(': ', $row);
			if ($header_value !== null) {
				$header[$header_key] = $header_value;
			}
			unset($header[$i]);
		}

		return $this->filter($header);
	}
}
