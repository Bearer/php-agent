<?php

namespace Bearer\Handler;

use Bearer\Request\CurlRequest;
use Bearer\DataStorage\CurlDataStorage;

/**
 * Class SetOptArrayHandler
 * @package Bearer\Handler
 */
class SetOptArrayHandler extends AbstractHandler
{
	/**
	 * @return string
	 */
	public static function getMethod(): string
	{
		return 'curl_setopt_array';
	}

	/**
	 * @param $ch
	 * @param array $options
	 * @return mixed
	 */
	public function __invoke($ch, array $options)
	{
		CurlRequest::get($ch)->addOptions($options);

		return base_curl_setopt_array($ch, $options);
	}
}
