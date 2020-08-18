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
	public function getType()
	{
		return $this->type;
	}

	/**
	 * @param string $type
	 * @return Agent
	 */
	public function setType($type)
	{
		$this->type = $type;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getVersion()
	{
		return $this->version;
	}

	/**
	 * @param string $version
	 * @return Agent
	 */
	public function setVersion($version)
	{
		$this->version = strval($version);
		return $this;
	}
}
