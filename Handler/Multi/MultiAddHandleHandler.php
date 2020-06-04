<?php

namespace Bearer\Handler\Multi;

use Bearer\Request\CurlRequest;
use Bearer\Handler\AbstractHandler;
use Bearer\Handler\Traits\CurlResponseListener;

/**
 * Class MultiAddHandleHandler
 * @package Bearer\Handler\Multi
 */
class MultiAddHandleHandler extends AbstractHandler
{
	use CurlResponseListener;

	/**
	 * @return string
	 */
	public static function getMethod(): string
	{
		return 'curl_multi_add_handle';
	}

	/**
	 * @param $mh
	 * @param $ch
	 * @return mixed
	 */
	public function __invoke($mh, $ch)
	{
		CurlRequest::get($ch)->setParent($mh);
		$this->addHeaderListener($ch);
		$this->addDataListener($ch);

		return base_curl_multi_add_handle($mh, $ch);
	}
}
