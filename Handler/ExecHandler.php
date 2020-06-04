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
		$this->addHeaderListener($ch);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		CurlRequest::get($ch)->addOptions([
			CurlResponse::CURLINFO_STARTTIME => round(microtime(true) * 1000)
		]);

		$response = base_curl_exec($ch);

		CurlRequest::get($ch)->getResponse()->setContent($response);

		$this->report($ch);

		return $response;
	}
}
