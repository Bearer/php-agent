<?php

namespace Bearer\Sh\Handler\Multi;

use Bearer\Sh\Async\AsyncClient;
use Bearer\Sh\Async\Task\HandlerEventTask;
use Bearer\Sh\Request\CurlRequest;
use Bearer\Sh\Request\CurlResponse;
use Bearer\Sh\Handler\AbstractHandler;
use Bearer\Sh\DataStorage\CurlDataStorage;

/**
 * Class MultiCloseHandler
 * @package Bearer\Sh\Handler\Multi
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
