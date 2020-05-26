<?php

namespace Bearer\Sh\Handler\Traits;

use Bearer\Sh\Request\CurlRequest;

/**
 * Class CurlResponseListener
 * @package Bearer\Sh\Handler\Traits
 */
trait CurlResponseListener
{
	/**
	 * @param resource $ch
	 */
	private function addCurlListener($ch): void
	{
		curl_setopt_array($ch, [
			CURLOPT_HEADERFUNCTION => static function ($ich, string $data) use ($ch): int {
				$request = CurlRequest::get($ch);

				$request->getResponse()->addHeader($ich, $data);
				return $request->hasOption(CURLOPT_HEADERFUNCTION) ?
					$request->getOptions()[CURLOPT_HEADERFUNCTION]($ich, $data) :
					\strlen($data);
			},
			CURLOPT_WRITEFUNCTION => static function ($ich, string $data) use ($ch) {
				$request = CurlRequest::get($ch);
				$request->getResponse()->addData($data);

				return $request->hasOption(CURLOPT_WRITEFUNCTION) ?
					$request->getOptions()[CURLOPT_WRITEFUNCTION]($ich, $data) :
					\strlen($data);
			}
		]);
	}
}
