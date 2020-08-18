<?php

namespace Bearer\Handler\Multi;

use Bearer\Request\CurlRequest;
use Bearer\Handler\AbstractHandler;
use Bearer\Handler\Traits\CurlResponseListener;

/**
 * Class MultiAddHandleHandler
 * @package Bearer\Handler\Multi
 */
class MultiAddHandleHandler extends AbstractHandler
{
	use CurlResponseListener;

	/**
	 * @param $mh
	 * @param $ch
	 * @return mixed
	 */
	public static function run($mh, $ch)
	{
		CurlRequest::get($ch)->setParent($mh);
		static::addHeaderListener($ch);
		static::addDataListener($ch);

		return curl_multi_add_handle($mh, $ch);
	}
}
