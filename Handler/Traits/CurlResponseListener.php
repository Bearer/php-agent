<?php

namespace Bearer\Handler\Traits;

use Bearer\Request\CurlRequest;

/**
 * Class CurlResponseListener
 * @package Bearer\Handler\Traits
 */
trait CurlResponseListener
{
	/**
	 * @param $ch
	 */
	private function addHeaderListener($ch): void
	{
		curl_setopt($ch, CURLOPT_HEADERFUNCTION, static function ($ich, string $data) use ($ch): int {
			$request = CurlRequest::get($ch);

			$request->getResponse()->addHeader($ich, $data);

			if ($request->hasOption(CURLOPT_HEADERFUNCTION)) {
				$request->getOptions()[CURLOPT_HEADERFUNCTION]($ich, $data);
			}

			return \strlen($data);
		});
	}

	/**
	 * @param $ch
	 */
	private function addDataListener($ch): void
	{
		curl_setopt($ch, CURLOPT_WRITEFUNCTION, static function ($ich, string $data) use ($ch) {
			$request = CurlRequest::get($ch);

			$request->getResponse()->addData($data);

			if ($request->hasOption(CURLOPT_WRITEFUNCTION)) {
				$request->getOptions()[CURLOPT_WRITEFUNCTION]($ich, $data);
			}
			return \strlen($data);
		});
	}
}
