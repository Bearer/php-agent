<?php

namespace Bearer\Model;

/**
 * Class Agent
 * @package Bearer\Model
 */
class Agent
{
	/**
	 * @var string
	 */
	private $type;

	/**
	 * @var string
	 */
	private $version;

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @param string $type
	 * @return Agent
	 */
	public function setType(string $type): Agent
	{
		$this->type = $type;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getVersion(): ?string
	{
		return $this->version;
	}

	/**
	 * @param string $version
	 * @return Agent
	 */
	public function setVersion(string $version): Agent
	{
		$this->version = strval($version);
		return $this;
	}
}
