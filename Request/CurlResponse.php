<?php

namespace Bearer\Request;

use Bearer\Sanitizer\BodySanitizer;
use Bearer\Sanitizer\HeaderSanitizer;

/**
 * Class CurlResponse
 * @package Bearer\Curl
 */
class CurlResponse
{
	use ResponseTrait;

	/**
	 * @var int
	 */
	const CURLINFO_STARTTIME = -100;

	/**
	 * @var CurlRequest
	 */
	private $request;

	/**
	 * @var int|null
	 */
	private $http_code = null;

	/**
	 * @var string|null
	 */
	private $location = null;

	/**
	 * CurlResponse constructor.
	 * @param CurlRequest $request
	 */
	public function __construct($request)
	{
		$this->request = $request;
	}

	/**
	 * @return int
	 */
	public function getEndTime()
	{
		return $this->getStartTime() + (int)(curl_getinfo($this->request->getResource(), CURLINFO_TOTAL_TIME) * 1000);
	}

	/**
	 * @return int
	 */
	public function getStartTime()
	{
		$default_value = function () {
			return round(microtime(true) * 1000) - (int)(curl_getinfo($this->request->getResource(), CURLINFO_TOTAL_TIME) * 1000);
		};

		return (int)$this->getOption(CurlResponse::CURLINFO_STARTTIME, $default_value());
	}

	/**
	 * @param $attr
	 * @param null $default
	 * @return mixed|null
	 */
	public function getOption($attr, $default = null)
	{
		return isset($this->request->getOptions()[$attr]) ? $this->request->getOptions()[$attr] : $default;
	}

	/**
	 * @return bool
	 */
	public function isSuccess()
	{
		return $this->http_code !== null;
	}

	/**
	 * @return int
	 */
	public function getStatusCode()
	{
		$code = intval($this->http_code !== null ? $this->http_code : curl_getinfo($this->request->getResource(), CURLINFO_RESPONSE_CODE));

		return $code > 0 ? $code : null;
	}

	/**
	 * @return array
	 */
	public function getUrlInformation()
	{
		$url = $this->location !== null ? $this->location :
			$this->getOption(
				CURLOPT_URL,
				curl_getinfo($this->request->getResource(), CURLINFO_EFFECTIVE_URL)
			);

		return array_merge(parse_url($url), [
			'url' => $url
		]);
	}

	/**
	 * @param int|null $attr
	 * @param null|callable $default
	 * @param null|callable $then
	 * @return mixed|null
	 */
	public function getOptions()
	{
		return $this->request->getOptions();
	}

	/**
	 * @return string
	 */
	public function getMethod()
	{
		return $this->http_method !== null ?
			$this->http_method :
			$this->getOption(
				CURLOPT_CUSTOMREQUEST,
				isset($this->getOptions()[CURLOPT_POST]) && $this->getOptions()[CURLOPT_POST] === true ? 'POST' : 'GET'
			);
	}

	/**
	 * @return string|array
	 */
	public function getRequestBody()
	{
		$sanitizer = new BodySanitizer;

		return $sanitizer(
			$this->getOption(CURLOPT_POSTFIELDS, false),
			$this->getRequestHeaders()
		);
	}

	/**
	 * @return array
	 */
	public function getRequestHeaders()
	{
		$sanitizer = new HeaderSanitizer();

		return $sanitizer($this->getOption(CURLOPT_HTTPHEADER, []));
	}

	/**
	 * @return string|array
	 */
	public function getResponseBody()
	{
		$sanitizer = new BodySanitizer;

		return $sanitizer(
			$this->getContent(),
			$this->getResponseHeaders(),
			$this->getResponseBodySize()
		);
	}

	/**
	 * @return array
	 */
	public function getResponseHeaders()
	{
		$sanitizer = new HeaderSanitizer();

		return $sanitizer($this->headers);
	}

	/**
	 * @return int
	 */
	public function getResponseBodySize()
	{
		return curl_getinfo($this->request->getResource(), CURLINFO_SIZE_DOWNLOAD);
	}
}
