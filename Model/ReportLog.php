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
	public function getLogLevel()
	{
		return $this->logLevel;
	}

	/**
	 * @param string $logLevel
	 * @return ReportLog
	 */
	public function setLogLevel($logLevel)
	{
		$this->logLevel = $logLevel;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getStartedAt()
	{
		return $this->startedAt;
	}

	/**
	 * @param int $startedAt
	 * @return ReportLog
	 */
	public function setStartedAt($startedAt)
	{
		$this->startedAt = $startedAt;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getEndedAt()
	{
		return $this->endedAt;
	}

	/**
	 * @param int $endedAt
	 * @return ReportLog
	 */
	public function setEndedAt($endedAt)
	{
		$this->endedAt = $endedAt;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * @param string $type
	 * @return ReportLog
	 */
	public function setType($type)
	{
		$this->type = $type;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getStageType()
	{
		return $this->stageType;
	}

	/**
	 * @param string $stageType
	 * @return ReportLog
	 */
	public function setStageType($stageType)
	{
		$this->stageType = $stageType;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getActiveDataCollectionRules()
	{
		return $this->activeDataCollectionRules;
	}

	/**
	 * @param array $activeDataCollectionRules
	 * @return ReportLog
	 */
	public function setActiveDataCollectionRules($activeDataCollectionRules)
	{
		$this->activeDataCollectionRules = $activeDataCollectionRules;
		return $this;
	}

	/**
	 * @param DataCollectionRule $dataCollectionRule
	 * @return $this
	 */
	public function addActiveDataCollectionRules($dataCollectionRule)
	{
		$this->activeDataCollectionRules[] = $dataCollectionRule;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getPort()
	{
		return $this->port;
	}

	/**
	 * @param int $port
	 * @return ReportLog
	 */
	public function setPort($port)
	{
		$this->port = $port;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getProtocol()
	{
		return $this->protocol;
	}

	/**
	 * @param string $protocol
	 * @return ReportLog
	 */
	public function setProtocol($protocol)
	{
		$this->protocol = $protocol;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getHostname()
	{
		return $this->hostname;
	}

	/**
	 * @param string $hostname
	 * @return ReportLog
	 */
	public function setHostname($hostname)
	{
		$this->hostname = $hostname;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPath()
	{
		return $this->path;
	}

	/**
	 * @param string $path
	 * @return ReportLog
	 */
	public function setPath($path)
	{
		$this->path = $path;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getMethod()
	{
		return $this->method;
	}

	/**
	 * @param string $method
	 * @return ReportLog
	 */
	public function setMethod($method)
	{
		$this->method = $method;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * @param string $url
	 * @return ReportLog
	 */
	public function setUrl($url)
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
	public function getStatusCode()
	{
		return $this->statusCode;
	}

	/**
	 * @param int $statusCode
	 * @return ReportLog
	 */
	public function setStatusCode($statusCode)
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
	public function setRequestBody($requestBody)
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
	public function setResponseBody($responseBody)
	{
		$this->responseBody = $responseBody;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getRequestBodyPayloadSha()
	{
		return $this->requestBodyPayloadSha;
	}

	/**
	 * @param string|null $requestBodyPayloadSha
	 * @return ReportLog
	 */
	public function setRequestBodyPayloadSha($requestBodyPayloadSha)
	{
		$this->requestBodyPayloadSha = $requestBodyPayloadSha;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getResponseBodySize()
	{
		return $this->responseBodySize;
	}

	/**
	 * @param int|null $responseBodySize
	 * @return ReportLog
	 */
	public function setResponseBodySize($responseBodySize)
	{
		$this->responseBodySize = $responseBodySize;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getResponseBodyPayloadSha()
	{
		return $this->responseBodyPayloadSha;
	}

	/**
	 * @param string|null $responseBodyPayloadSha
	 * @return ReportLog
	 */
	public function setResponseBodyPayloadSha($responseBodyPayloadSha)
	{
		$this->responseBodyPayloadSha = $responseBodyPayloadSha;
		return $this;
	}

    /**
     * @return int|null
     */
	public function getErrorCode()
	{
		return $this->errorCode;
	}

	/**
	 * @param int $errorCode
	 * @return ReportLog
	 */
	public function setErrorCode($errorCode)
	{
		$this->errorCode = $errorCode;
		return $this;
	}

    /**
     * @return string|null
     */
	public function getErrorFullMessage()
	{
		return $this->errorFullMessage;
	}

	/**
	 * @param string $errorFullMessage
	 * @return ReportLog
	 */
	public function setErrorFullMessage($errorFullMessage)
	{
		$this->errorFullMessage = $errorFullMessage;
		return $this;
	}
}
