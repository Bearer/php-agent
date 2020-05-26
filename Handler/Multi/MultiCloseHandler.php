<?php

namespace Bearer\Sh\Handler\Multi;

use Bearer\Sh\Async\AsyncClient;
use Bearer\Sh\Async\Task\HandlerEventTask;
use Bearer\Sh\Handler\AbstractHandler;

/**
 * Class MultiCloseHandler
 * @package Bearer\Sh\Handler\Multi
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
