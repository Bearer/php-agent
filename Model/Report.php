<?php

namespace Bearer\Model;

/**
 * Class Report
 * @package Bearer\Model
 */
class Report
{
	/**
	 * @var string
	 */
	private $secretKey;

	/**
	 * @var string
	 */
	private $appEnvironment;

	/**
	 * @var Runtime
	 */
	private $runtime;

	/**
	 * @var Runtime
	 */
	private $agent;

	/**
	 * @var array
	 */
	private $logs = [];

	/**
	 * @return string
	 */
	public function getSecretKey()
	{
		return $this->secretKey;
	}

	/**
	 * @param string $secretKey
	 * @return Report
	 */
	public function setSecretKey($secretKey)
	{
		$this->secretKey = $secretKey;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getAppEnvironment()
	{
		return $this->appEnvironment;
	}

	/**
	 * @param string $appEnvironment
	 * @return Report
	 */
	public function setAppEnvironment($appEnvironment)
	{
		$this->appEnvironment = base64_encode($appEnvironment);
		return $this;
	}

	/**
	 * @return Runtime
	 */
	public function getRuntime()
	{
		return $this->runtime;
	}

	/**
	 * @param Runtime $runtime
	 * @return Report
	 */
	public function setRuntime($runtime)
	{
		$this->runtime = $runtime;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getAgent()
	{
		return $this->agent;
	}

	/**
	 * @param mixed $agent
	 * @return Report
	 */
	public function setAgent($agent)
	{
		$this->agent = $agent;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLogs()
	{
		return $this->logs;
	}

	/**
	 * @param mixed $logs
	 * @return Report
	 */
	public function setLogs($logs)
	{
		$this->logs = $logs;
		return $this;
	}
}
