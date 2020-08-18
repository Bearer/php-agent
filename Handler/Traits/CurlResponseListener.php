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
	private static function addHeaderListener($ch)
	{
		curl_setopt($ch, CURLOPT_HEADERFUNCTION, static function ($ich, $data) use ($ch) {
			$request = CurlRequest::get($ch);

			$request->getResponse()->addHeader($ich, $data);

			if ($request->hasOption(CURLOPT_HEADERFUNCTION)) {
				$function = $request->getOptions()[CURLOPT_HEADERFUNCTION];

				return $function($ich, $data);
			}

			return \strlen($data);
		});
	}

	/**
	 * @param $ch
	 */
	private static function addDataListener($ch)
	{
		curl_setopt($ch, CURLOPT_WRITEFUNCTION, static function ($ich, $data) use ($ch) {
			$request = CurlRequest::get($ch);

			$request->getResponse()->addData($data);

			if ($request->hasOption(CURLOPT_WRITEFUNCTION)) {
				$function = $request->getOptions()[CURLOPT_WRITEFUNCTION];

				return $function($ich, $data);
			}
			return \strlen($data);
		});
	}
}
