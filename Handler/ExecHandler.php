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
	 * @return string
	 */
	public static function getMethod(): string
	{
		return 'curl_exec';
	}

	/**
	 * @param $ch
	 * @return mixed
	 */
	public function __invoke($ch)
	{
		$this->addCurlListener($ch);

		CurlRequest::get($ch)->addOptions([
			CurlResponse::CURLINFO_STARTTIME => round(microtime(true) * 1000)
		]);

		$response = base_curl_exec($ch);

		$this->report($ch);

		return $response;
	}
}
