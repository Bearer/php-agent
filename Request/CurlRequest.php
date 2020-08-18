<?php

namespace Bearer\Request;

/**
 * Class CurlRequest
 * @package Bearer\Curl
 */
class CurlRequest
{
	const STATE_WAITING = 'waiting';
	const STATE_SEND = 'sended';

	/**
	 * @var array
	 */
	private static $instances = [];
	/**
	 * @var resource
	 */
	public $ch;
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
	public static function get($resource)
	{
		if (!isset(self::$instances[intval($resource)])) {
			self::$instances[intval($resource)] = new CurlRequest($resource);
		}
		return self::$instances[intval($resource)];
	}

	/**
	 * @param $resource
	 */
	public static function remove($resource)
	{
		if (isset(self::$instances[intval($resource)])) {
			unset(self::$instances[intval($resource)]);
		}
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
	public function addOptions($options)
	{
		foreach ($options as $k => $v) {
			$this->options[$k] = $v;
		}

		return $this;
	}

	/**
	 * @param string $attr
	 * @return bool
	 */
	public function hasOption($attr)
	{
		return isset($this->getOptions()[$attr]);
	}

	/**
	 * @return array
	 */
	public function getOptions()
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
	public function getParent()
	{
		return $this->parent === null ? null : self::$instances[$this->parent];
	}

	/**
	 * @param $resource
	 * @return $this
	 */
	public function setParent($resource)
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
	public function getResponse()
	{
		if ($this->response === null) {
			$this->response = new CurlResponse($this);
		}

		return $this->response;
	}

	/**
	 * @return bool
	 */
	public function isSend()
	{
		return $this->state === self::STATE_SEND;
	}

	/**
	 * @param string $state
	 *
	 * @return CurlRequest
	 */
	public function setState($state)
	{
		if (in_array($state, [self::STATE_WAITING, self::STATE_SEND])) {
			$this->state = $state;
		}
		return $this;
	}
}
