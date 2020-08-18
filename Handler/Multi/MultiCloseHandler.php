<?php

namespace Bearer\Handler\Multi;

use Bearer\Handler\AbstractHandler;

/**
 * Class MultiCloseHandler
 * @package Bearer\Handler\Multi
 */
class MultiCloseHandler extends AbstractHandler
{
	/**
	 * @param $mh
	 * @return mixed
	 */
	public static function run($mh)
	{
		do {
			curl_multi_info_read($mh, $msgs_in_queue);
		} while ($msgs_in_queue);

		return curl_multi_close($mh);
	}
}
