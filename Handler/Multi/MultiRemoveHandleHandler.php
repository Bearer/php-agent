<?php

namespace Bearer\Sh\Handler\Multi;

use Bearer\Sh\Handler\AbstractHandler;
use Bearer\Sh\Report\ReportSender;

/**
 * Class MultiRemoveHandleHandler
 * @package Bearer\Sh\Handler\Multi
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
