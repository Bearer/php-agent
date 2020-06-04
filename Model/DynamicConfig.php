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
	public function getLogLevel(): ?string
	{
		return $this->logLevel;
	}

	/**
	 * @param string|null $logLevel
	 * @return DynamicConfig
	 */
	public function setLogLevel(?string $logLevel): DynamicConfig
	{
		$this->logLevel = $logLevel;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isActive(): bool
	{
		return $this->active;
	}

	/**
	 * @param bool $active
	 * @return DynamicConfig
	 */
	public function setActive(bool $active): DynamicConfig
	{
		$this->active = $active;

		return $this;
	}
}
