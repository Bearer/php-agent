<?php

namespace Bearer\Handler;

use Bearer\Request\CurlRequest;
use Bearer\Request\CurlResponse;
use Bearer\Handler\Traits\CurlResponseListener;

/**
 * Class ExecHandler
 * @package Bearer\Handler
 */
class ExecHandler extends AbstractHandler
{
	use CurlResponseListener;

	/**
	 * @param $ch
	 * @return mixed
	 */
	public static function run($ch)
	{
		static::addHeaderListener($ch);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		CurlRequest::get($ch)->addOptions([
			CurlResponse::CURLINFO_STARTTIME => round(microtime(true) * 1000)
		]);

		$response = curl_exec($ch);
		CurlRequest::get($ch)->getResponse()->setContent($response);

		static::report($ch);

		CurlRequest::remove($ch);

		return $response;
	}
}
