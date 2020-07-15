<?php

namespace Bearer\Model;

/**
 * Class ReportLog
 * @package Bearer\Model
 */
class ReportLog
{
	/**
	 * @var string
	 */
	private $logLevel;

	/**
	 * @var int
	 */
	private $startedAt;

	/**
	 * @var int
	 */
	private $endedAt;

	/**
	 * @var string
	 */
	private $type;

	/**
	 * @var string
	 */
	private $stageType;

	/**
	 * @var array
	 */
	private $activeDataCollectionRules = [];

	/**
	 * @var int
	 */
	private $port;

	/**
	 * @var string
	 */
	private $protocol;

	/**
	 * @var string
	 */
	private $hostname;

	/**
	 * @var string
	 */
	private $path;

	/**
	 * @var string
	 */
	private $method;

	/**
	 * @var string
	 */
	private $url;

	/**
	 * @var array
	 */
	private $requestHeaders;

	/**
	 * @var array
	 */
	private $responseHeaders;

	/**
	 * @var int
	 */
	private $statusCode;

	/**
	 * @var string
	 */
	private $requestBody;

	/**
	 * @var string
	 */
	private $responseBody;

	/**
	 * @var int
	 */
	private $responseBodySize;

	/**
	 * @var string|null
	 */
	private $requestBodyPayloadSha;

	/**
	 * @var string|null
	 */
	private $responseBodyPayloadSha;

	/**
	 * @var int
	 */
	private $errorCode;

	/**
	 * @var string
	 */
	private $errorFullMessage;

    /**
     * @return string|null
     */
	public function getLogLevel(): ?string
	{
		return $this->logLevel;
	}

	/**
	 * @param string $logLevel
	 * @return ReportLog
	 */
	public function setLogLevel(string $logLevel): ReportLog
	{
		$this->logLevel = $logLevel;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getStartedAt(): int
	{
		return $this->startedAt;
	}

	/**
	 * @param int $startedAt
	 * @return ReportLog
	 */
	public function setStartedAt(int $startedAt): ReportLog
	{
		$this->startedAt = $startedAt;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getEndedAt(): int
	{
		return $this->endedAt;
	}

	/**
	 * @param int $endedAt
	 * @return ReportLog
	 */
	public function setEndedAt(int $endedAt): ReportLog
	{
		$this->endedAt = $endedAt;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @param string $type
	 * @return ReportLog
	 */
	public function setType(string $type): ReportLog
	{
		$this->type = $type;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getStageType(): string
	{
		return $this->stageType;
	}

	/**
	 * @param string $stageType
	 * @return ReportLog
	 */
	public function setStageType(string $stageType): ReportLog
	{
		$this->stageType = $stageType;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getActiveDataCollectionRules(): array
	{
		return $this->activeDataCollectionRules;
	}

	/**
	 * @param array $activeDataCollectionRules
	 * @return ReportLog
	 */
	public function setActiveDataCollectionRules(array $activeDataCollectionRules): ReportLog
	{
		$this->activeDataCollectionRules = $activeDataCollectionRules;
		return $this;
	}

	/**
	 * @param DataCollectionRule $dataCollectionRule
	 * @return $this
	 */
	public function addActiveDataCollectionRules(DataCollectionRule $dataCollectionRule): ReportLog
	{
		$this->activeDataCollectionRules[] = $dataCollectionRule;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getPort(): int
	{
		return $this->port;
	}

	/**
	 * @param int $port
	 * @return ReportLog
	 */
	public function setPort(int $port): ReportLog
	{
		$this->port = $port;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getProtocol(): string
	{
		return $this->protocol;
	}

	/**
	 * @param string $protocol
	 * @return ReportLog
	 */
	public function setProtocol(string $protocol): ReportLog
	{
		$this->protocol = $protocol;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getHostname(): string
	{
		return $this->hostname;
	}

	/**
	 * @param string $hostname
	 * @return ReportLog
	 */
	public function setHostname(string $hostname): ReportLog
	{
		$this->hostname = $hostname;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPath(): string
	{
		return $this->path;
	}

	/**
	 * @param string $path
	 * @return ReportLog
	 */
	public function setPath(string $path): ReportLog
	{
		$this->path = $path;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getMethod(): string
	{
		return $this->method;
	}

	/**
	 * @param string $method
	 * @return ReportLog
	 */
	public function setMethod(string $method): ReportLog
	{
		$this->method = $method;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getUrl(): string
	{
		return $this->url;
	}

	/**
	 * @param string $url
	 * @return ReportLog
	 */
	public function setUrl(string $url): ReportLog
	{
		$this->url = $url;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getRequestHeaders()
	{
		return $this->requestHeaders;
	}

	/**
	 * @param mixed $requestHeaders
	 * @return ReportLog
	 */
	public function setRequestHeaders($requestHeaders)
	{
		$this->requestHeaders = $requestHeaders;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getResponseHeaders()
	{
		return $this->responseHeaders;
	}

	/**
	 * @param mixed $responseHeaders
	 * @return ReportLog
	 */
	public function setResponseHeaders($responseHeaders)
	{
		$this->responseHeaders = $responseHeaders;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getStatusCode(): ?int
	{
		return $this->statusCode;
	}

	/**
	 * @param int $statusCode
	 * @return ReportLog
	 */
	public function setStatusCode(?int $statusCode): ReportLog
	{
		$this->statusCode = $statusCode;
		return $this;
	}

	/**
	 * @return string|array
	 */
	public function getRequestBody()
	{
		return $this->requestBody;
	}

	/**
	 * @param string|array $requestBody
	 * @return ReportLog
	 */
	public function setRequestBody($requestBody): ReportLog
	{
		$this->requestBody = $requestBody;
		return $this;
	}

	/**
	 * @return string|array
	 */
	public function getResponseBody()
	{
		return $this->responseBody;
	}

	/**
	 * @param string|array $responseBody
	 * @return ReportLog
	 */
	public function setResponseBody($responseBody): ReportLog
	{
		$this->responseBody = $responseBody;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getRequestBodyPayloadSha(): ?string
	{
		return $this->requestBodyPayloadSha;
	}

	/**
	 * @param string|null $requestBodyPayloadSha
	 * @return ReportLog
	 */
	public function setRequestBodyPayloadSha(?string $requestBodyPayloadSha): ReportLog
	{
		$this->requestBodyPayloadSha = $requestBodyPayloadSha;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getResponseBodySize(): ?int
	{
		return $this->responseBodySize;
	}

	/**
	 * @param int|null $responseBodySize
	 * @return ReportLog
	 */
	public function setResponseBodySize(?int $responseBodySize): ReportLog
	{
		$this->responseBodySize = $responseBodySize;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getResponseBodyPayloadSha(): ?string
	{
		return $this->responseBodyPayloadSha;
	}

	/**
	 * @param string|null $responseBodyPayloadSha
	 * @return ReportLog
	 */
	public function setResponseBodyPayloadSha(?string $responseBodyPayloadSha): ReportLog
	{
		$this->responseBodyPayloadSha = $responseBodyPayloadSha;
		return $this;
	}

    /**
     * @return int|null
     */
	public function getErrorCode(): ?int
	{
		return $this->errorCode;
	}

	/**
	 * @param int $errorCode
	 * @return ReportLog
	 */
	public function setErrorCode(?int $errorCode): ReportLog
	{
		$this->errorCode = $errorCode;
		return $this;
	}

    /**
     * @return string|null
     */
	public function getErrorFullMessage(): ?string
	{
		return $this->errorFullMessage;
	}

	/**
	 * @param string $errorFullMessage
	 * @return ReportLog
	 */
	public function setErrorFullMessage(string $errorFullMessage): ReportLog
	{
		$this->errorFullMessage = $errorFullMessage;
		return $this;
	}
}
