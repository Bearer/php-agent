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
			$headers = explode(': ', $row);
			if (isset($headers[0], $headers[1]) && $headers[1] !== null) {
				$header[$headers[0]] = $headers[1];
			}
			unset($header[$i]);
		}

		return $this->filter($header);
	}
}
