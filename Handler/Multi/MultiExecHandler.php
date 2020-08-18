<?php

namespace Bearer\Handler\Multi;

use Bearer\Request\CurlRequest;
use Bearer\Request\CurlResponse;
use Bearer\Handler\AbstractHandler;

/**
 * Class MultiCloseHandler
 * @package Bearer\Handler\Multi
 */
class MultiExecHandler extends AbstractHandler
{

	/**
	 * @param $mh
	 * @param int|null $still_running
	 */
	public static function run($mh, &$still_running = null)
	{
		CurlRequest::get($mh)->addOptions([
			CurlResponse::CURLINFO_STARTTIME => 	round(microtime(true) * 1000)
		]);

		return curl_multi_exec($mh, $still_running);
	}
}
