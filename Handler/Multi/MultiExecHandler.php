<?php

namespace Bearer\Handler\Multi;

use Bearer\Async\AsyncClient;
use Bearer\Async\Task\HandlerEventTask;
use Bearer\Request\CurlRequest;
use Bearer\Request\CurlResponse;
use Bearer\Handler\AbstractHandler;
use Bearer\DataStorage\CurlDataStorage;

/**
 * Class MultiCloseHandler
 * @package Bearer\Handler\Multi
 */
class MultiExecHandler extends AbstractHandler
{
	/**
	 * @return string
	 */
	public static function getMethod(): string
	{
		return 'curl_multi_exec';
	}

	/**
	 * @param $mh
	 * @param int|null $still_running
	 */
	public function __invoke($mh,int &$still_running = null)
	{
		CurlRequest::get($mh)->addOptions([
			CurlResponse::CURLINFO_STARTTIME => 	round(microtime(true) * 1000)
		]);

		return base_curl_multi_exec($mh, $still_running);
	}
}
