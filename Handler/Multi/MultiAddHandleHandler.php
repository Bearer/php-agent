<?php

namespace Bearer\Sh\Handler\Multi;

use Bearer\Sh\Request\CurlRequest;
use Bearer\Sh\Handler\AbstractHandler;
use Bearer\Sh\Handler\Traits\CurlResponseListener;

/**
 * Class MultiAddHandleHandler
 * @package Bearer\Sh\Handler\Multi
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
		$this->addCurlListener($ch);

		return base_curl_multi_add_handle($mh, $ch);
	}
}
