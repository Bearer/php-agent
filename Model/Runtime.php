<?php

namespace Bearer\Model;

/**
 * Class Runtime
 */
class Runtime
{
	/**
	 * @var string
	 */
	private $arch;

	/**
	 * @var string
	 */
	private $type;

	/**
	 * @var string
	 */
	private $platform;

	/**
	 * @var string
	 */
	private $hostname;

	/**
	 * @var string
	 */
	private $version;

	/**
	 * @return string
	 */
	public function getArch()
	{
		return $this->arch;
	}

	/**
	 * @param string $arch
	 * @return Runtime
	 */
	public function setArch($arch)
	{
		$this->arch = $arch;
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
	 * @return Runtime
	 */
	public function setType($type)
	{
		$this->type = $type;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPlatform()
	{
		return $this->platform;
	}

	/**
	 * @param string $platform
	 * @return Runtime
	 */
	public function setPlatform($platform)
	{
		$this->platform = $platform;
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
	 * @return Runtime
	 */
	public function setHostname($hostname)
	{
		$this->hostname = $hostname;
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
	 * @return Runtime
	 */
	public function setVersion($version)
	{
		$this->version = $version;
		return $this;
	}
}
