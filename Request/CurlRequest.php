<?php

namespace Bearer\Sh\Request;

/**
 * Class CurlRequest
 * @package Bearer\Sh\Curl
 */
class CurlRequest
{
	public const STATE_WAITING = 'waiting';
	public const STATE_SEND = 'sended';

	/**
	 * @var array
	 */
	private static $instances = [];

	/**
	 * @var int|null
	 */
	private $parent = null;

	/**
	 * @var array
	 */
	private $options = [];

	/**
	 * @var CurlResponse|null
	 */
	private $response = null;

	/**
	 * @var resource
	 */
	private $ch;

	/**
	 * @var string
	 */
	private $state = self::STATE_WAITING;

	/**
	 * CurlRequest constructor.
	 * @param resource $ch
	 */
	public function __construct($ch)
	{
		$this->ch = $ch;
	}

	/**
	 * @param $resource
	 * @return static
	 */
	public static function get($resource): self
	{
		if (!isset(self::$instances[intval($resource)])) {
			self::$instances[intval($resource)] = new CurlRequest($resource);
		}
		return self::$instances[intval($resource)];
	}

	/**
	 * @return resource
	 */
	public function getResource()
	{
		return $this->ch;
	}

	/**
	 * @param array $options
	 * @return $this
	 */
	public function addOptions(array $options): self
	{
		$this->options += $options;

		return $this;
	}

	/**
	 * @param string $attr
	 * @return bool
	 */
	public function hasOption(string $attr): bool
	{
		return isset($this->getOptions()[$attr]);
	}

	/**
	 * @return array
	 */
	public function getOptions(): array
	{
		$options = $this->options;
		if ($this->getParent() !== null) {
			$options += ($this->getParent()->getOptions());
		}

		return $options;
	}


	/**
	 * @return $this|null
	 */
	public function getParent(): ?self
	{
		return $this->parent === null ? null : self::$instances[$this->parent];
	}

	/**
	 * @param $resource
	 * @return $this
	 */
	public function setParent($resource): self
	{
		$this->parent = intval($resource);

		if (!isset(self::$instances[$this->parent])) {
			self::$instances[$this->parent] = new CurlRequest($resource);
		}

		return $this;
	}

	/**
	 * @return CurlResponse
	 */
	public function getResponse(): CurlResponse
	{
		if ($this->response === null) {
			$this->response = new CurlResponse($this);
		}

		return $this->response;
	}

	/**
	 * @return bool
	 */
	public function isSend(): bool
	{
		return $this->state === self::STATE_SEND;
	}

	/**
	 * @param string $state
	 *
	 * @return CurlRequest
	 */
	public function setState(string $state): CurlRequest
	{
		if (in_array($state, [self::STATE_WAITING, self::STATE_SEND])) {
			$this->state = $state;
		}
		return $this;
	}
}
