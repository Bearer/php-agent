<?php

namespace Bearer\Handler\Multi;

use Bearer\Async\AsyncClient;
use Bearer\Async\Task\HandlerEventTask;
use Bearer\Handler\AbstractHandler;

/**
 * Class MultiCloseHandler
 * @package Bearer\Handler\Multi
 */
class MultiCloseHandler extends AbstractHandler
{
	/**
	 * @return string
	 */
	public static function getMethod(): string
	{
		return 'curl_multi_close';
	}

	/**
	 * @param $mh
	 * @return mixed
	 */
	public function __invoke($mh)
	{
		do {
			curl_multi_info_read($mh, $msgs_in_queue);
		} while ($msgs_in_queue);

		return base_curl_multi_close($mh);
	}
}
