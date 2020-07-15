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
	public const CURLINFO_STARTTIME = -100;

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
	public function __construct(CurlRequest $request)
	{
		$this->request = $request;
	}

	/**
	 * @return int
	 */
	public function getEndTime(): int
	{
		return $this->getStartTime() + (int)(curl_getinfo($this->request->getResource(), CURLINFO_TOTAL_TIME) * 1000);
	}

	/**
	 * @return int
	 */
	public function getStartTime(): int
	{
		$default_value = function () {
			return round(microtime(true) * 1000) - (int)(curl_getinfo($this->request->getResource(), CURLINFO_TOTAL_TIME) * 1000);
		};

		return (int)$this->getOptions()[CurlResponse::CURLINFO_STARTTIME] ?? $default_value();
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
	 * @return bool
	 */
	public function isSuccess(): bool
	{
		return $this->http_code !== null;
	}

	/**
	 * @return int
	 */
	public function getStatusCode(): ?int
	{
		$code = intval($this->http_code ?? curl_getinfo($this->request->getResource(), CURLINFO_RESPONSE_CODE));

		return $code > 0 ? $code : null;
	}

	/**
	 * @return array
	 */
	public function getUrlInformation(): array
	{
		$url = $this->location ?? ($this->getOptions()[CURLOPT_URL] ?? curl_getinfo($this->request->getResource(), CURLINFO_EFFECTIVE_URL));

		return array_merge(parse_url($url), [
			'url' => $url
		]);
	}

	/**
	 * @return string
	 */
	public function getMethod(): string
	{
		return $this->http_method ?? ($this->getOptions()[CURLOPT_CUSTOMREQUEST] ?? ($this->getOptions()[CURLOPT_POST] ? 'POST' : 'GET'));
	}

	/**
	 * @return string|array
	 */
	public function getRequestBody()
	{
		return (new BodySanitizer)(
			$this->getOptions()[CURLOPT_POSTFIELDS] ?? false,
			$this->getRequestHeaders()
		);
	}

	/**
	 * @return array
	 */
	public function getRequestHeaders(): array
	{
		return (new HeaderSanitizer)($this->getOptions()[CURLOPT_HTTPHEADER] ?? []);
	}

	/**
	 * @return string|array
	 */
	public function getResponseBody()
	{
		return (new BodySanitizer)(
			$this->getContent(),
			$this->getResponseHeaders(),
			$this->getResponseBodySize()
		);
	}

	/**
	 * @return array
	 */
	public function getResponseHeaders(): array
	{
		return (new HeaderSanitizer)($this->headers);
	}

	/**
	 * @return int
	 */
	public function getResponseBodySize(): ?int
	{
		return curl_getinfo($this->request->getResource(), CURLINFO_SIZE_DOWNLOAD);
	}
}
