<?php

namespace Bearer\Handler\Multi;

use Bearer\Handler\AbstractHandler;
use Bearer\Request\CurlRequest;

/**
 * Class MultiRemoveHandleHandler
 * @package Bearer\Handler\Multi
 */
class MultiRemoveHandleHandler extends AbstractHandler
{
	/**
	 * @param $mh
	 * @param $ch
	 * @return mixed
	 */
	public static function run($mh, $ch)
	{
		static::report($ch);
		CurlRequest::remove($ch);

		return curl_multi_remove_handle($mh, $ch);
	}
}
