<?php

namespace Bearer\Request\Chunk;

use Bearer\Exception\TransportException;

/**
 * Class ErrorChunk
 * @package Bearer\Request\Chunk
 */
class ErrorChunk implements ChunkInterface
{

	/**
	 * @var bool
	 */
	private $didThrow = false;

	/**
	 * @var int
	 */
	private $offset;

	/**
	 * @var string
	 */
	private $errorMessage;

	/**
	 * @var string|\Throwable
	 */
	private $error;

	/**
	 * @param \Throwable|string $error
	 */
	public function __construct($offset, $error)
	{
		$this->offset = $offset;

		if (\is_string($error)) {
			$this->errorMessage = $error;
		} else {
			$this->error = $error;
			$this->errorMessage = method_exists($error, 'getMessage') ? $error->getMessage() : '';
		}
	}

	/**
	 * @return bool
	 */
	public function isTimeout()
	{
		$this->didThrow = true;

		if (null !== $this->error) {
			throw new TransportException($this->errorMessage, 0, $this->error);
		}

		return true;
	}

	/**
	 * @return bool
	 */
	public function isFirst()
	{
		$this->didThrow = true;
		throw new TransportException($this->errorMessage, 0, $this->error);
	}

	/**
	 * @return bool
	 */
	public function isLast()
	{
		$this->didThrow = true;
		throw new TransportException($this->errorMessage, 0, $this->error);
	}

	/**
	 * @return array|null
	 */
	public function getInformationalStatus()
	{
		$this->didThrow = true;
		throw new TransportException($this->errorMessage, 0, $this->error);
	}

	/**
	 * @return string
	 */
	public function getContent()
	{
		$this->didThrow = true;
		throw new TransportException($this->errorMessage, 0, $this->error);
	}

	/**
	 * @return int
	 */
	public function getOffset()
	{
		return $this->offset;
	}

	/**
	 * @return string|null
	 */
	public function getError()
	{
		return $this->errorMessage;
	}

	/**
	 * @return bool Whether the wrapped error has been thrown or not
	 */
	public function didThrow()
	{
		return $this->didThrow;
	}

	/**
	 * @return void
	 */
	public function __destruct()
	{
		if (!$this->didThrow) {
			$this->didThrow = true;
			throw new TransportException($this->errorMessage, 0, $this->error);
		}
	}
}
