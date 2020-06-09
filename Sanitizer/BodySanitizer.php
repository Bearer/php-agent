<?php

namespace Bearer\Sanitizer;

/**
 * Class BodySanitizer
 * @package Bearer\Sanitizer\Handler
 */
class BodySanitizer extends AbstractSanitizeHandler
{
	/**
	 * @param $data
	 * @param array $headers
	 * @param $size
	 */
	public function __invoke($data, array $headers, $size = null)
	{
		if ($data === false) {
			return '(no body)';
		}

		if ($size !== null && $size / 1048576 > 1) {
			return '(omitted due to size)';
		}

		if (
			$this->getHeaderValue($headers, 'content-encoding') === 'gzip' &&
			function_exists('gzdecode') &&
			0 === mb_strpos($data , "\x1f" . "\x8b" . "\x08")
		) {
			$data = gzdecode($data);
		}

		$type = $this->getHeaderValue($headers, 'content-type');

		json_decode($data);
		if (json_last_error() === JSON_ERROR_NONE) {
			$type = "application/json";
		}

		if ($type !== null) {
			if (!preg_match("/json|text|xml|x-www-form-urlencoded/i", $type)) {
				$data = "(not showing binary data)";
			}
			if (preg_match('/json/i', $type)) {
				$data = json_decode($data, true);
			}
		}

		$data = $this->filter($data);

		return is_array($data) ? json_encode($data, JSON_NUMERIC_CHECK) : $data;
	}

	/**
	 * @param array $headers
	 * @param $attr
	 * @param null $default
	 * @return string|null
	 */
	private function getHeaderValue(array $headers, $attr, $default = null): ?string
	{
		$attr = strtolower($attr);

		return $headers[$attr] ?? ($headers[ucwords($attr, '-')] ?? $default);
	}
}
