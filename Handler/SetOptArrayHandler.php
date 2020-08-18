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
	 * @param $ch
	 * @param array $options
	 * @return mixed
	 */
	public static function run($ch, $options)
	{
		CurlRequest::get($ch)->addOptions($options);

		return curl_setopt_array($ch, $options);
	}
}
