<?php

namespace Bearer\Handler\Multi;

use Bearer\Handler\AbstractHandler;
use Bearer\Report\ReportSender;

/**
 * Class MultiRemoveHandleHandler
 * @package Bearer\Handler\Multi
 */
class MultiRemoveHandleHandler extends AbstractHandler
{
	/**
	 * @return string
	 */
	public static function getMethod(): string
	{
		return 'curl_multi_remove_handle';
	}

	/**
	 * @param $mh
	 * @param $ch
	 * @return mixed
	 */
	public function __invoke($mh, $ch)
	{
		$this->report($ch);

		return base_curl_multi_remove_handle($mh, $ch);
	}
}
