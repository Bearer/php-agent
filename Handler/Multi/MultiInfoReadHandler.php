<?php

namespace Bearer\Handler\Multi;

use Bearer\Handler\AbstractHandler;
use Bearer\Report\ReportSender;

/**
 * Class MultiInfoReadHandler
 * @package Bearer\Handler\Multi
 */
class MultiInfoReadHandler extends AbstractHandler
{
	/**
	 * @return string
	 */
	public static function getMethod(): string
	{
		return 'curl_multi_info_read';
	}

	/**
	 * @param $mh
	 * @param $still_running
	 * @return mixed
	 */
	public function __invoke($mh, ?int &$msgs_in_queue = null)
	{
		$result = base_curl_multi_info_read($mh, $msgs_in_queue);
		if ($mh !== null && $result !== false) {
			$this->report($result['handle']);
		}
		return $result;
	}

}
