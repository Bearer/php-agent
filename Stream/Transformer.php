<?php

namespace Bearer\Stream;

/**
 * Class Transformer
 * @package Bearer\Hook
 */
class Transformer
{
	const NAME = 'vcr_curl';

	/**
	 * Flag to signalize the current filter is registered.
	 *
	 * @var bool
	 */
	private static $initialized = false;

	/**
	 * @var array
	 */
	private static $handlers = [];

	/**
	 * Transformer constructor.
	 * @param array $handlers
	 */
	public function __construct($handlers = null)
	{
		if ($handlers !== null) {
			static::$handlers = $handlers;
		}
	}

	/**
	 * Attaches the current filter to a stream.
	 *
	 * @return self
	 */
	public function register()
	{
		if (!static::$initialized) {
			static::$initialized = stream_filter_register(static::NAME, get_called_class());
		}

		return $this;
	}

	/**
	 * Applies the current filter to a provided stream.
	 *
	 * @param resource $in
	 * @param resource $out
	 * @param int $consumed
	 * @param bool $closing
	 *
	 * @return int PSFS_PASS_ON
	 *
	 * @link http://www.php.net/manual/en/php-user-filter.filter.php
	 */
	public function filter($in, $out, &$consumed, $closing)
	{
		while ($bucket = stream_bucket_make_writeable($in)) {
			$bucket->data = $this->transform($bucket->data);
			$consumed += $bucket->datalen;
			stream_bucket_append($out, $bucket);
		}

		return PSFS_PASS_ON;
	}

	/**
	 * @param $code
	 * @return string|string[]|null
	 */
	protected function transform($code)
	{
		return preg_replace(
			array_values(
				array_map(function ($method) {
					return '/(?<!::|->|\w_)\\\?' . $method . '\s*\(/i';
				}, array_keys(static::$handlers))
			)
			,
			array_values(
				array_map(function ($handler) {
					return "\\$handler::run(";
				}, static::$handlers)
			),
			$code);
	}
}
