<?php

namespace Bearer\Sh\Model;

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
	public function getArch(): string
	{
		return $this->arch;
	}

	/**
	 * @param string $arch
	 * @return Runtime
	 */
	public function setArch(string $arch): Runtime
	{
		$this->arch = $arch;
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
	 * @return Runtime
	 */
	public function setType(string $type): Runtime
	{
		$this->type = $type;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPlatform(): string
	{
		return $this->platform;
	}

	/**
	 * @param string $platform
	 * @return Runtime
	 */
	public function setPlatform(string $platform): Runtime
	{
		$this->platform = $platform;
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
	 * @return Runtime
	 */
	public function setHostname(string $hostname): Runtime
	{
		$this->hostname = $hostname;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getVersion(): string
	{
		return $this->version;
	}

	/**
	 * @param string $version
	 * @return Runtime
	 */
	public function setVersion(string $version): Runtime
	{
		$this->version = $version;
		return $this;
	}
}
