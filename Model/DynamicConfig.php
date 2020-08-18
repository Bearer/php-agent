<?php

namespace Bearer\Model;

/**
 * Class DynamicConfig
 */
class DynamicConfig
{
	/**
	 * @var string|null
	 */
	private $logLevel;

	/**
	 * @var bool
	 */
	private $active = false;

	/**
	 * @return string|null
	 */
	public function getLogLevel()
	{
		return $this->logLevel;
	}

	/**
	 * @param string|null $logLevel
	 * @return DynamicConfig
	 */
	public function setLogLevel($logLevel)
	{
		$this->logLevel = $logLevel;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isActive()
	{
		return $this->active;
	}

	/**
	 * @param bool $active
	 * @return DynamicConfig
	 */
	public function setActive($active)
	{
		$this->active = $active;

		return $this;
	}
}
