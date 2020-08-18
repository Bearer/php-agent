<?php

namespace Bearer\Handler\Multi;

use Bearer\Handler\AbstractHandler;

/**
 * Class MultiInfoReadHandler
 * @package Bearer\Handler\Multi
 */
class MultiInfoReadHandler extends AbstractHandler
{

	/**
	 * @param $mh
	 * @param $still_running
	 * @return mixed
	 */
	public static function run($mh, &$msgs_in_queue = null)
	{
		$result = curl_multi_info_read($mh, $msgs_in_queue);
		if ($mh !== null && $result !== false) {
			static::report($result['handle']);
		}
		return $result;
	}

}
